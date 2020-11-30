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
        // Data from $request variable
        $data = [
            'title' => ucfirst($request->title),
            'type' => ucfirst($request->type),
            'fullname' => ucwords($request->fullname),
            'email' => $request->email,
            'message' => ucfirst($request->message),
            'status' => ucfirst($request->status),
        ];

        // Creates ticket with $data values
        Ticket::create($data);

        return redirect()->back()->with('message', __('Message has been sent!'));
    }
}
