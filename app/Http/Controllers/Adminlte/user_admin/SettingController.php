<?php

namespace App\Http\Controllers\Adminlte\user_admin;

use App\Country;
use App\Models\Adminlte\user_admin\Setting;
use App\Http\Controllers\Controller;
use App\Http\Requests\NotificationRequest;
use App\Http\Requests\PasswordSecurityRequest;
use App\Http\Requests\PersonalInfoRequest;
use App\Http\Requests\ProfileImageRequest;
use App\Traits\UploadTrait;
use App\User;
use Hashids\Hashids;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    use UploadTrait;

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        // Finds all countries and stores in $countries
        $countries = Country::all();

        // Hash key for id security
        $hashids = new Hashids(env("HASHIDS"), 10);

        // Finds users id by Auth model
        $id = Auth::id();

        $activeUserGroup = $request->session()->get("groupId");

        $groups = DB::table('monitoring_group_members')
            ->join('monitoring_users_groups','monitoring_users_groups.group_id','monitoring_group_members.group_id')
            ->where('group_member',$id)
            ->get(['monitoring_group_members.group_id','group_name']);

        // Finds user by $id
        $user = User::find($id);

        // Finds country by $countryID
        $countryName = Country::find($user->country);
        
        return view('adminlte.user_admin.settings', compact('countries', 'hashids', 'user', 'countryName','groups','activeUserGroup'));
    }

    /**
     * Updates personal info in account settings section
     *
     * @param PersonalInfoRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function personal_info_update(PersonalInfoRequest $request, $id)
    {
        // Hash key for id security
        $hashids = new Hashids('WEBcheck', 10);

        // get user id
        $id = $request
            ->session()
            ->get("login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d");

        // Finds user by $id
        $user = User::where('id',$id)->first();

        // Finds country name by $request->country
        $countryName = Country::where('name', !empty($request->country) ? $request->country : $request->country_old)->first();

        // Changing date format - from string to date
        $time = strtotime(str_replace('/', '-', $request->birthday));

        // Checks if $time is null
        if ($time == null)
        {
            $birthday = null;
        }

        else
        {
            $birthday = date('Y-m-d', $time);
        }

        // Storing new info in $data
        $data = [
            'name' => ucwords($request->fullname),
            'email' => $request->email_address,
            'phone_number' => $request->phone_without_mask,
            'country' => !empty($countryName->id) ? $countryName->id : null,
            'city' => !empty(ucfirst($request->city)) ? ucfirst($request->city) : null,
            'gender' => !empty(ucfirst($request->gender)) ? ucfirst($request->gender) : $request->gender_old,
            'birthday' => !empty($birthday) ? $birthday : $request->birthday_old,
        ];

        //Updates user with $data values
        $user->update($data);

        return redirect()->back()->with('message', __(':attribute - :action', ['attribute' => __("Personal Information"), 'action' => __("has been updated!")]));
    }

    /**
     * Updates notification in account settings section
     *
     * @param NotificationRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function notification_update(NotificationRequest $request,$id)
    {
        // Hash key for id security
        $hashids = new Hashids('WEBcheck', 10);

        // Decodes id
        $id = $hashids->decode( $id );

        dd("Need to create notification section");

        return redirect()->back()->with('message', __(':attribute - :action', ['attribute' => __("Notifications"), 'action' => __("has been updated!")]));
    }

    /**
     * Updates password security in account settings section
     *
     * @param PasswordSecurityRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password_security_update(PasswordSecurityRequest $request, $id)
    {
        // Hash key for id security
        $hashids = new Hashids('WEBcheck', 10);

        // get user id
        $id = $request
            ->session()
            ->get("login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d");

        // Finds user by $id
        $user = User::where('id',$id)->first();

        // Storing new info in $data
        $data = [
            'password'=> Hash::make($request->new_password),
        ];
        
        //Set new password
        $user->password = $data['password'];

        // Updates user with $data values
        $user->save();

        return redirect()->back()->with('message', __(':attribute - :action', ['attribute' => __("Password & Security"), 'action' => __("has been updated!")]));
    }

    /**
     * Updates password security in account settings section
     *
     * @param $groupid
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeGroup(Request $request, $groupid)
    {
  
        // get user id
        $userId = $request
            ->session()
            ->get("login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d");

        $userIsMember = DB::table('monitoring_group_members')
            ->where('group_member',$userId)
            ->where('group_id',$groupid)
            ->get()->first();

        if($userIsMember){
            //Set new group to user to global variable (groupId)
            session(['groupId' => $groupid]);

            $hostGroupID = DB::table('monitoring_hosts_groups')
                ->where('user_group',$groupid)
                ->get('host_group_id')->first()->host_group_id;

            //Set current user host group's id to global variable
            session(['hostGroup' => $hostGroupID]);

        }


        return redirect()->back();
    }

    /**
     * Updates user profile image in account settings section
     *
     * @param ProfileImageRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfile(ProfileImageRequest $request)
    {

        // Get current user
        $user = User::findOrFail(auth()->user()->id);

        // Check if a profile image has been uploaded
        if ($request->has('profile_image'))
        {
            // Previous profile image path
            $usersImage = public_path($user->profile_image);

            // Checks if file exists
            if (File::exists($usersImage))
            {
                // Deletes previous profile image
                File::delete($usersImage);
            }

            // Get image file
            $image = $request->file('profile_image');

            // Make a image name based on user name and current timestamp
            $name = Str::slug($user->name).'_'.time();

            // Define folder path
            $folder = '/storage/uploads/profile_images/';

            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();

            // Upload image
            $this->uploadOne($image, $folder, 'public', $name);

            // Set user profile image path in database to filePath
            $user->profile_image = $filePath;
        }

        // Persist user record to database
        $user->save();

        return redirect()->back()->with('message', __(':attribute - :action', ['attribute' => __("Profile image"), 'action' => __("has been updated!")]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Setting $setting
     * @return Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Setting $setting
     * @return Response
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Setting $setting
     * @return Response
     */
    public function update(Request $request, Setting $setting)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Setting $setting
     * @return Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
