<?php

namespace App\Http\Controllers\Adminlte\user_admin\Reports;

use App\Models\Adminlte\user_admin\Reports\ReportUptime;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ReportUptimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index()
    {
        return view('adminlte.user_admin.reports.uptime');
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
     * @param ReportUptime $reportUptime
     * @return Response
     */
    public function show(ReportUptime $reportUptime)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ReportUptime $reportUptime
     * @return Response
     */
    public function edit(ReportUptime $reportUptime)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param ReportUptime $reportUptime
     * @return Response
     */
    public function update(Request $request, ReportUptime $reportUptime)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ReportUptime $reportUptime
     * @return Response
     */
    public function destroy(ReportUptime $reportUptime)
    {
        //
    }
}
