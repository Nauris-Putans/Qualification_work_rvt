<?php

namespace App\Http\Controllers\Adminlte\user_admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index($id)
    {

        $userInfo = DB::table('users')
            ->join('countries', 'countries.id', '=', 'users.id')
            ->join('role_user', 'role_user.user_id', '=', 'users.id')
            ->join('roles', 'roles.id', '=', 'role_user.role_id')
            ->where('users.id',$id)
            ->get(['users.name as fullName','email','roles.display_name','profile_image','phone_number','gender','birthday','countries.name as country','city']);

        return view('adminlte.user_admin.user-profile',compact(['userInfo']));
    }
}
