<?php

namespace App\Http\Controllers\Adminlte;

use App\Http\Controllers\Controller;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('adminlte.settings');
    }
}
