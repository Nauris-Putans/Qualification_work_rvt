<?php

namespace App\Http\Controllers\Adminlte\user_admin\monitoring;

use App\Models\Adminlte\user_admin\Monitoring\MonitoringUptime;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class MonitoringUptimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index()
    {
        return view('adminlte.user_admin.monitoring.uptime');
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
     * @param MonitoringUptime $monitoringUptime
     * @return Response
     */
    public function show(MonitoringUptime $monitoringUptime)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param MonitoringUptime $monitoringUptime
     * @return Response
     */
    public function edit(MonitoringUptime $monitoringUptime)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param MonitoringUptime $monitoringUptime
     * @return Response
     */
    public function update(Request $request, MonitoringUptime $monitoringUptime)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param MonitoringUptime $monitoringUptime
     * @return Response
     */
    public function destroy(MonitoringUptime $monitoringUptime)
    {
        //
    }
}
