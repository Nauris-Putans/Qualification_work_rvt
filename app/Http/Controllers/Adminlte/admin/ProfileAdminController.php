<?php

namespace App\Http\Controllers\Adminlte\admin;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ProfileAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index($id)
    {
        // Finds user by user id
        $user = User::find($id);

        // Finds user_id from table 'role_user' by user id
        $roleID = DB::table('role_user')
            ->where('user_id', $id)
            ->get();

        // Retrieves all of the values for a given key
        $roleID = $roleID->pluck('role_id');

        // Finds id from table 'roles' by $roleID variable
        $role = DB::table('roles')
            ->where('id', $roleID)
            ->get()
            ->first();

        return view('adminlte.admin.profile-admin', compact('user', 'role'));
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
     * @param  User  $id
     * @return Response
     */
    public function show(User $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User  $id
     * @return Response
     */
    public function edit(User $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  User  $id
     * @return Response
     */
    public function update(Request $request, User $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User  $id
     * @return Response
     */
    public function destroy(User $id)
    {
        //
    }
}
