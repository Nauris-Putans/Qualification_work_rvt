<?php

namespace App\Http\Controllers\Adminlte\user_admin\Monitoring;

use App\Models\Adminlte\user_admin\Monitoring\MonitoringPageSpeed;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class MonitoringPageSpeedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index()
    {
        return view('adminlte.user_admin.monitoring.page-speed');
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
     * @param MonitoringPageSpeed $monitoringPageSpeed
     * @return Response
     */
    public function show(MonitoringPageSpeed $monitoringPageSpeed)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param MonitoringPageSpeed $monitoringPageSpeed
     * @return Response
     */
    public function edit(MonitoringPageSpeed $monitoringPageSpeed)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param MonitoringPageSpeed $monitoringPageSpeed
     * @return Response
     */
    public function update(Request $request, MonitoringPageSpeed $monitoringPageSpeed)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param MonitoringPageSpeed $monitoringPageSpeed
     * @return Response
     */
    public function destroy(MonitoringPageSpeed $monitoringPageSpeed)
    {
        //
    }
}
