<?php

namespace App\Http\Controllers\Adminlte\user_admin\Reports;

use App\Models\Adminlte\user_admin\Reports\ReportTransaction;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ReportTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index()
    {
        return view('adminlte.user_admin.reports.transaction');
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
     * @param ReportTransaction $reportTransaction
     * @return Response
     */
    public function show(ReportTransaction $reportTransaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ReportTransaction $reportTransaction
     * @return Response
     */
    public function edit(ReportTransaction $reportTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param ReportTransaction $reportTransaction
     * @return Response
     */
    public function update(Request $request, ReportTransaction $reportTransaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ReportTransaction $reportTransaction
     * @return Response
     */
    public function destroy(ReportTransaction $reportTransaction)
    {
        //
    }
}
