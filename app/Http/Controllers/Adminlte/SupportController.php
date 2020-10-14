<?php

namespace App\Http\Controllers\Adminlte;

use App\Http\Controllers\Controller;
use App\Support;
use App\Http\Requests\ContactCreateRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SupportController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('adminlte.support');
    }
}
