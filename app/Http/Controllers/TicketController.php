<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserTicketCreateRequest;
use App\Mailers\AppMailer;
use App\Models\Category;
use App\Models\Ticket;
use App\Role;
use App\User;
use Hashids\Hashids;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
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
        $hashids = new Hashids(env("HASHIDS"), 10);

        // Finds all tickets
        $tickets = Ticket::all();

        // Finds all users
        $tickets_users = User::all();

        return view('adminlte.admin.tickets', compact('tickets', 'tickets_users', 'hashids'));
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

        // Sets current language to $locale
        $locale = Config::get('app.locale');

        $user_closedBy = User::all();

        // Sets locale for all data types (php)
        setlocale(LC_ALL, $locale . '_utf8');

        return view('adminlte.admin.view-tickets', compact('ticket', 'hashids', 'user_closedBy'));
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
     * Stores users ticket from contacts page to database
     *
     * @param UserTicketCreateRequest $request
     * @param AppMailer $mailer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function userStoreTicket(UserTicketCreateRequest $request)
    {
        // Priorities based on category
        switch ($request->category)
        {
            case "1":
                $priority = 'Low';
                break;
            case "2":
                $priority = 'Medium';
                break;
            case "3":
                $priority = 'High';
                break;
            case "4":
                $priority = 'Low';
                break;
        }

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
            'priority' => $priority,
            'message' => ucfirst($request->message),
            'action' => ucwords($action),
            'status' => ucfirst($request->status)
        ];

        // Creates ticket with $data
        $ticket = Ticket::create($data);

        // Mail info
        $to = Auth::user()->email;
        $from = ['address' => "info.webcheck@gmail.com", 'name' => __("Ticket Robot")];
        $subject = __("[Ticket ID: #:ticket_id] :ticket_title", ['ticket_id' => $ticket->ticket_id, 'ticket_title' => $ticket->title]);

        // Sends ticket information
        MailController::sendTicketInformation($data, $subject, $from, $to, Auth::user(), $ticket);

        return redirect()->back()->with('message', __("Ticket with ID: #:ticket_id - :action", ['ticket_id' => $ticketID, 'action' => __("has been created!")]));
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

        // Sets current language to $locale
        $locale = Config::get('app.locale');

        $user_closedBy = User::all();

        // Sets locale for all data types (php)
        setlocale(LC_ALL, $locale . '_utf8');

        return view('adminlte.user_admin.support.support-ticket-show', compact('ticket', 'hashids', 'user_closedBy'));
    }

    /**
     * Closes ticket
     *
     * @param $ticket_id
     * @param AppMailer $mailer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function close($ticket_id)
    {
        // Finds ticket by $ticket_id
        $ticket = Ticket::where('ticket_id', $ticket_id)->firstOrFail();

        // Sets tickets status and action values
        $ticket->status = "Closed";
        $ticket->action = "Solved";
        $ticket->closed_by = Auth::user()->id;

        // Saves changes to ticket
        $ticket->save();

        // Sets ticket owner from $ticket->user
        $ticketOwner = $ticket->user;

        if ($ticketOwner->id !== Auth::user()->id)
        {
            // Mail info
            $to = $ticketOwner->email;
            $from = ['address' => "info.webcheck@gmail.com", 'name' => __("Ticket Robot")];
            $subject = __("RE: :ticket_title [Ticket ID: #:ticket_id]", ['ticket_title' => $ticket->title, 'ticket_id' => $ticket->ticket_id]);

            // Sends ticket status notification
            MailController::sendTicketStatusNotification($subject, $from, $to, $ticketOwner, $ticket, Auth::user());
        }

        return redirect()->back()->with('message', __("The ticket #:ticket_id - :action", ['ticket_id' => $ticket->ticket_id, 'action' => __("has been resolved and closed!")]));
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

        return redirect()->back()->with('message', __("Ticket with ID: #:ticket_id - :action", ['ticket_id' => $ticket->ticket_id, 'action' => __("has been deleted!")]));
    }
}
