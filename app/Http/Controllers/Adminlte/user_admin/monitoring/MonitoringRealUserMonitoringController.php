<?php

namespace App\Http\Controllers\Adminlte\user_admin\monitoring;

use App\Models\Adminlte\user_admin\Monitoring\MonitoringRealUserMonitoring;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class MonitoringRealUserMonitoringController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index()
    {
        return view('adminlte.user_admin.monitoring.real-user-monitoring');
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
     * @param MonitoringRealUserMonitoring $monitoringRealUserMonitoring
     * @return Response
     */
    public function show(MonitoringRealUserMonitoring $monitoringRealUserMonitoring)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param MonitoringRealUserMonitoring $monitoringRealUserMonitoring
     * @return Response
     */
    public function edit(MonitoringRealUserMonitoring $monitoringRealUserMonitoring)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param MonitoringRealUserMonitoring $monitoringRealUserMonitoring
     * @return Response
     */
    public function update(Request $request, MonitoringRealUserMonitoring $monitoringRealUserMonitoring)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param MonitoringRealUserMonitoring $monitoringRealUserMonitoring
     * @return Response
     */
    public function destroy(MonitoringRealUserMonitoring $monitoringRealUserMonitoring)
    {
        //
    }
}
