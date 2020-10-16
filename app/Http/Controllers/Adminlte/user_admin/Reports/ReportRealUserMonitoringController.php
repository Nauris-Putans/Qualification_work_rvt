<?php

namespace App\Http\Controllers\Adminlte\user_admin\Reports;

use App\Models\Adminlte\user_admin\Reports\ReportRealUserMonitoring;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ReportRealUserMonitoringController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index()
    {
        return view('adminlte.user_admin.reports.real-user-monitoring');
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
     * @param ReportRealUserMonitoring $reportRealUserMonitoring
     * @return Response
     */
    public function show(ReportRealUserMonitoring $reportRealUserMonitoring)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ReportRealUserMonitoring $reportRealUserMonitoring
     * @return Response
     */
    public function edit(ReportRealUserMonitoring $reportRealUserMonitoring)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param ReportRealUserMonitoring $reportRealUserMonitoring
     * @return Response
     */
    public function update(Request $request, ReportRealUserMonitoring $reportRealUserMonitoring)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ReportRealUserMonitoring $reportRealUserMonitoring
     * @return Response
     */
    public function destroy(ReportRealUserMonitoring $reportRealUserMonitoring)
    {
        //
    }
}
