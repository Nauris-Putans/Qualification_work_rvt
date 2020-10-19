<?php

namespace App\Http\Controllers\Adminlte\admin\users;

use App\Models\Adminlte\admin\users\UsersList;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class UsersListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index()
    {
        return view('adminlte.admin.users.users-list');
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
     * @param UsersList $usersList
     * @return Response
     */
    public function show(UsersList $usersList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param UsersList $usersList
     * @return Response
     */
    public function edit(UsersList $usersList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param UsersList $usersList
     * @return Response
     */
    public function update(Request $request, UsersList $usersList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param UsersList $usersList
     * @return Response
     */
    public function destroy(UsersList $usersList)
    {
        //
    }
}
