<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserTicketCreateRequest;
use App\Mailers\AppMailer;
use App\Models\Category;
use App\Models\Ticket;
use App\Role;
use Hashids\Hashids;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Str;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index()
    {
        // Hash key for id security
        $hashids = new Hashids('WEBcheck', 10);

        // Finds all tickets
        $tickets = Ticket::all();

        return view('adminlte.admin.tickets', compact('tickets', 'hashids'));
    }


    /**
     * Display the specified resource.
     *
     * @param $id
     * @return Factory|View
     */
    public function show($id)
    {
        // Hash key for id security
        $hashids = new Hashids('WEBcheck', 10);

        // Decodes id
        $id = $hashids->decode( $id );

        // Finds user by user id
        $ticket = Ticket::find($id)->first();

        return view('adminlte.admin.view-tickets', compact('ticket', 'hashids'));
    }

    /**
     * Returns user ticket create view
     *
     * @return Factory|View
     */
    public function userCreateTicket()
    {
        // Finds all categorys
        $categories = Category::all();

        return view('adminlte.user_admin.support.support-ticket-create', compact('categories'));
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
     * Stores users ticket from contacts page to database
     *
     * @param UserTicketCreateRequest $request
     * @param AppMailer $mailer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function userStoreTicket(UserTicketCreateRequest $request, AppMailer $mailer)
    {
        // Removes _ from string
        $action = str_replace('_', ' ', $request->action);

        // Generates random string for $ticketID
        $ticketID = strtoupper(Str::random(9));

        // Data from $request variable
        $data = [
            'title' => ucfirst($request->title),
            'user_id' => Auth::user()->id,
            'ticket_id' => $ticketID,
            'category_id' => ucfirst($request->category),
            'priority' => ucfirst($request->priority),
            'message' => ucfirst($request->message),
            'action' => ucwords($action),
            'status' => ucfirst($request->status)
        ];

        // Creates ticket with $data
        $ticket = Ticket::create($data);

        // Sends ticket information
        $mailer->sendTicketInformation(Auth::user(), $ticket);

        return redirect()->back()->with('message', __("A ticket with ID: #") . $ticketID . __(" has been created."));
    }

    /**
     * Returns user tickets view
     *
     * @return Factory|View
     */
    public function userTickets()
    {
        // Hash key for id security
        $hashids = new Hashids('WEBcheck', 10);

        // Finds ticket by auth user id
        $tickets = Ticket::where('user_id', Auth::user()->id)->get();

        return view('adminlte.user_admin.support.support', compact('tickets', 'hashids'));
    }

    /**
     * Shows user specific ticket
     *
     * @param $id
     * @return Factory|View
     */
    public function userShowTicket($id)
    {
        // Hash key for id security
        $hashids = new Hashids('WEBcheck', 10);

        // Decodes id
        $id = $hashids->decode($id);

        // Finds user by user id
        $ticket = Ticket::where('id', $id)->first();

        return view('adminlte.user_admin.support.support-ticket-show', compact('ticket', 'hashids'));
    }

    /**
     * Closes ticket
     *
     * @param $ticket_id
     * @param AppMailer $mailer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function close($ticket_id, AppMailer $mailer)
    {
        // Finds ticket by $ticket_id
        $ticket = Ticket::where('ticket_id', $ticket_id)->firstOrFail();

        // Sets tickets status and action values
        $ticket->status = "Closed";
        $ticket->action = "Solved";

        // Saves changes to ticket
        $ticket->save();

        // Sets ticket owner from $ticket->user
        $ticketOwner = $ticket->user;

        // Sends ticket status notification
        $mailer->sendTicketStatusNotification($ticketOwner, $ticket);

        return redirect()->back()->with('message', __("The ticket #") . $ticket->ticket_id . " - " . $ticket->title . __("has been closed."));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Ticket $ticket
     * @return Response
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Ticket $ticket
     * @return Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        // Hash key for id security
        $hashids = new Hashids('WEBcheck', 10);

        // Decodes id
        $id = $hashids->decode( $id );

        // Finds role by user id
        $ticket = Ticket::find($id)->first();

        // Deletes role
        $ticket->delete();

        return redirect()->back()->with('message', __('Ticket - #') . $ticket->ticket_id . __(' has been deleted!'));
    }
}
