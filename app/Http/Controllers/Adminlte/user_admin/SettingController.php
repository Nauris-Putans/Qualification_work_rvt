<?php

namespace App\Http\Controllers\Adminlte\user_admin;

use App\Models\Adminlte\user_admin\Setting;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $currentUserID = $id = Auth::id();//Get current user ID;
        $countries = DB::table('countries')->get();//Get current user Group;
        $userName = DB::table('users')->where('id', $currentUserID)->get('name')->first();//Get user name;
        $email = DB::table('users')->where('id', $currentUserID)->get('email')->first();//Get user email;
        $phone = DB::table('users')->where('id', $currentUserID)->get('phone_number')->first();//Get user phone;
        $birthDay = DB::table('users')->where('id', $currentUserID)->get('birthday')->first();//Get user birthday;
        $city = DB::table('users')->where('id', $currentUserID)->get('city')->first();//Get user city;

        return view('adminlte.user_admin.settings', compact(['countries','userName','email','phone','birthDay','city']));
    }

    /**
     * @param Setting $setting
     * @return Response
     */
    public function personal_info(Request $request){
        dd($request->all());
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
