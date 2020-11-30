<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactCreateRequest;
use App\Models\Adminlte\admin\Ticket;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class ContactController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('sections.contacts');
    }

    /**
     * @param ContactCreateRequest $request
     * @return RedirectResponse
     */
    public function store(ContactCreateRequest $request)
    {
        Ticket::create($request->all());

        return redirect()->back()->with('message', 'Message has been sent!');
    }
}
