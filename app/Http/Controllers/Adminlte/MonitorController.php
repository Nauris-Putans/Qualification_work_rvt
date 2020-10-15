<?php

namespace App\Http\Controllers\Adminlte;

use App\Http\Controllers\Controller;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MonitorController extends Controller
{
//    public function store()
//    {
//        return view('adminlte.monitoring.monitors.add');
//    }

    public function history()
    {
        return view('adminlte.user_admin.monitoring.monitors.history');
    }

    /**
     * @return Application|Factory|View
     */
    public function pageSpeed()
    {
        return view('adminlte.user_admin.monitoring.page-speed');
    }

    /**
     * @return Application|Factory|View
     */
    public function realUserMonitoring()
    {
        return view('adminlte.user_admin.monitoring.real-user-monitoring');
    }

    /**
     * @return Application|Factory|View
     */
    public function transaction()
    {
        return view('adminlte.user_admin.monitoring.transaction');
    }

    /**
     * @return Application|Factory|View
     */
    public function uptime()
    {
        return view('adminlte.user_admin.monitoring.uptime');
    }
}
