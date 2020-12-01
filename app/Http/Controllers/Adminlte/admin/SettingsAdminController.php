<?php

namespace App\Http\Controllers\Adminlte\admin;

use App\Country;
use App\Models\Adminlte\admin\SettingsAdmin;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class SettingsAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index()
    {
        $countries = Country::all();
        return view('adminlte.admin.account-settings-admin', compact('countries'));
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
     * @param SettingsAdmin $settingsAdmin
     * @return Response
     */
    public function show(SettingsAdmin $settingsAdmin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param SettingsAdmin $settingsAdmin
     * @return Response
     */
    public function edit(SettingsAdmin $settingsAdmin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param SettingsAdmin $settingsAdmin
     * @return Response
     */
    public function update(Request $request, SettingsAdmin $settingsAdmin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param SettingsAdmin $settingsAdmin
     * @return Response
     */
    public function destroy(SettingsAdmin $settingsAdmin)
    {
        //
    }
}
