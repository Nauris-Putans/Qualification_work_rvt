<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Role;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

//Zabbix
use Becker\Zabbix\ZabbixApi;
use Becker\Zabbix\ZabbixException;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RedirectsUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * The ZabbixApi instance.
     *
     * @var ZabbixApi
     */
    protected $zabbix;
    /**
     * Create a new Zabbix API instance.
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->zabbix = app('zabbix');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     *@throws ZabbixException
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'signup_name' => 'required|string|min:3|max:255',
            'signup_email' => 'required|email|string|min:3|max:255|unique:users,email',
            'signup_password' => 'required|string|min:8|max:255|confirmed'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['signup_name'],
            'email' => $data['signup_email'],
            'password' => Hash::make($data['signup_password']),
        ]);
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function register(Request $request)
    {
        // Validates register form
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        // Finds role - UserFree and adds it to new created user
        $role = Role::find(1);
        $user->syncRoles([$role->id]);

        //Get current user ID;
        $currentUserID = DB::table('users')
            ->where('email',$request->all()['signup_email'])
            ->get('id')
            ->first()->id;

        //Create new user in Zabbix
        $newZabbixUser = $this->zabbix->userCreate([
            "alias"=> $request->all()['signup_name'].' '.$request->all()['signup_email'],
            "passwd"=> $request->all()['signup_password'],
            "usrgrps"=> [
                [
                    "usrgrpid"=> "13"
                ]
            ],
            "user_medias"=> [
                [
                    "mediatypeid"=> "1", //Mail
                    "sendto"=> [
                        $request->all()['signup_email'] //Email 
                    ],
                ]
            ]
        ])->userids[0];

        //Add new user group to database
        DB::table('monitoring_users_groups')->insert(
            [
                'group_id' => 'G'.$currentUserID,
                'group_admin_id' => $currentUserID,
                'group_name' => $request->all()['signup_name'].' group'
            ]
        );

        //Add new group member to database
        DB::table('monitoring_group_members')->insert(
            [
                'group_id' => 'G'.$currentUserID,
                'group_member' => $currentUserID,
                'group_member_permission' => 1
            ]
        );


        //Add new zabbix user to database
        DB::table('monitoring_zabbix_users')->insert(
            [
                'zabbix_user_id' => $newZabbixUser,
                'user_id' => $currentUserID,
            ]
        );

        //Get user group id
        $userGroupId = DB::table('monitoring_users_groups')->where('group_admin_id',$currentUserID)->get('group_id')->first()->group_id;

        //Create new host group in zabbix
        $hostGroupID = $this->zabbix->hostgroupCreate([
            "name" => $userGroupId.'-Hosts'
        ])->groupids[0];

         //Add host group to database
         DB::insert('insert into monitoring_hosts_groups (host_group_id, host_group_name, user_group) values (?, ?, ?)', [$hostGroupID, $userGroupId.'-Hosts', $userGroupId]);

        //Set current user group's id to global variable
        session(['groupId' => $userGroupId]);

        //Set current user host group's id to global variable
        session(['hostGroup' => $hostGroupID]);

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect($this->redirectPath());
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        //
    }
}
