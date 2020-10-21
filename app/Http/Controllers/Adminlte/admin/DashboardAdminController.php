<?php

namespace App\Http\Controllers\Adminlte\admin;

use App\Models\Adminlte\admin\DashboardAdmin;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class DashboardAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index()
    {
        return view('adminlte.admin.index-admin');
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
     * @param DashboardAdmin $dashboard
     * @return Response
     */
    public function show(DashboardAdmin $dashboard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param DashboardAdmin $dashboard
     * @return Response
     */
    public function edit(DashboardAdmin $dashboard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param DashboardAdmin $dashboard
     * @return Response
     */
    public function update(Request $request, DashboardAdmin $dashboard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DashboardAdmin $dashboard
     * @return Response
     */
    public function destroy(DashboardAdmin $dashboard)
    {
        //
    }
}
