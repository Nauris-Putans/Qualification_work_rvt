<?php

namespace App\Http\Controllers\Adminlte;

use App\Http\Controllers\Controller;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AlertController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function list()
    {
        return view('adminlte.alerts.list');
    }

    /**
     * @return Application|Factory|View
     */
    public function onCall()
    {
        return view('adminlte.alerts.on-call');
    }
}
