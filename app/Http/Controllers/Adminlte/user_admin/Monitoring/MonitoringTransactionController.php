<?php

namespace App\Http\Controllers\Adminlte\user_admin\Monitoring;

use App\Models\Adminlte\user_admin\Monitoring\MonitoringTransaction;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class MonitoringTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index()
    {
        return view('adminlte.user_admin.monitoring.transaction');
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
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MonitoringTransaction  $monitoringTransaction
     * @return Response
     */
    public function show(MonitoringTransaction $monitoringTransaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MonitoringTransaction  $monitoringTransaction
     * @return Response
     */
    public function edit(MonitoringTransaction $monitoringTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MonitoringTransaction  $monitoringTransaction
     * @return Response
     */
    public function update(Request $request, MonitoringTransaction $monitoringTransaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MonitoringTransaction  $monitoringTransaction
     * @return Response
     */
    public function destroy(MonitoringTransaction $monitoringTransaction)
    {
        //
    }
}
