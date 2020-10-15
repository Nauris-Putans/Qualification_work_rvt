<?php

namespace App\Http\Controllers\Adminlte;

use App\Http\Controllers\Controller;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReportController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function pageSpeed()
    {
        return view('adminlte.user_admin.reports.page-speed');
    }

    /**
     * @return Application|Factory|View
     */
    public function realUserMonitoring()
    {
        return view('adminlte.user_admin.reports.real-user-monitoring');
    }

    /**
     * @return Application|Factory|View
     */
    public function transaction()
    {
        return view('adminlte.user_admin.reports.transaction');
    }

    /**
     * @return Application|Factory|View
     */
    public function uptime()
    {
        return view('adminlte.user_admin.reports.uptime');
    }
}
