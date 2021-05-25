<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MailController;
use App\Http\Requests\ContactCreateRequest;
use App\Mailers\AppMailer;
use App\Models\Adminlte\admin\Ticket;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\View\View;
class ContactController extends Controller
{
    /**
     * Returns view
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('sections.contacts');
    }

    /**
     * Sends ticket to info email
     *
     * @param ContactCreateRequest $request
     * @return RedirectResponse
     */
    public function store(ContactCreateRequest $request, AppMailer $mailer)
    {
        // Priorities based on category
        switch ($request->category)
        {
            case "question":
                $priority = 'Low';
                break;
            case "problem":
                $priority = 'Medium';
                break;
            case "job-vacancie":
                $priority = 'High';
                break;
            case "other":
                $priority = 'Low';
                break;
        }

        // Removes _ from string
        $action = str_replace('_', ' ', $request->action);

        // Data from $request variable
        $data = [
            'title' => ucfirst($request->title),
            'fullname' => ucwords($request->fullname),
            'email' => $request->email,
            'category' => ucfirst($request->category),
            'priority' => $priority,
            'message' => ucfirst($request->message),
            'action' => ucwords($action),
            'status' => ucfirst($request->status)
        ];

        // Mail info
        $to = "info.webcheck@gmail.com";
        $from = ['address' => $data['email'], 'name' => $data['fullname']];
        $subject = __("Ticket from contact section - :ticket-title", ['ticket-title' => $data['title']]);

        // Sends ticket to support email
        MailController::sendTicketToEmail($data, $subject, $from, $to);

        return redirect()->back()->with('success', __('Your :attribute - :action', ['attribute' => __("message"), 'action' => __("has been sent!")]));
    }
}
