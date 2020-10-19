<?php

namespace App\Http\Controllers\Adminlte\user_admin\Monitoring\Monitors;

use App\Models\Adminlte\user_admin\Monitoring\Monitors\MonitoringMonitors;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class MonitoringMonitorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|Response|View
     */
    public function create()
    {
        return view('adminlte.user_admin.monitoring.monitors.add');
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
     * @param MonitoringMonitors $monitoringMonitors
     * @return Response
     */
    public function show(MonitoringMonitors $monitoringMonitors)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param MonitoringMonitors $monitoringMonitors
     * @return Response
     */
    public function edit(MonitoringMonitors $monitoringMonitors)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param MonitoringMonitors $monitoringMonitors
     * @return Response
     */
    public function update(Request $request, MonitoringMonitors $monitoringMonitors)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param MonitoringMonitors $monitoringMonitors
     * @return Response
     */
    public function destroy(MonitoringMonitors $monitoringMonitors)
    {
        //
    }
}
