<?php

namespace App\Http\Controllers\Adminlte\user_admin\Alerts;

use App\Models\Adminlte\user_admin\Alerts\AlertOnCall;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class AlertOnCallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index()
    {
        return view('adminlte.user_admin.alerts.on-call');
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
     * @param AlertOnCall $alertOnCall
     * @return Response
     */
    public function show(AlertOnCall $alertOnCall)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param AlertOnCall $alertOnCall
     * @return Response
     */
    public function edit(AlertOnCall $alertOnCall)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param AlertOnCall $alertOnCall
     * @return Response
     */
    public function update(Request $request, AlertOnCall $alertOnCall)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param AlertOnCall $alertOnCall
     * @return Response
     */
    public function destroy(AlertOnCall $alertOnCall)
    {
        //
    }
}
