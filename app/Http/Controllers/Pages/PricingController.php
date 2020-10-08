<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PricingController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('sections/pricing');
    }
}
