<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\SendMail;
use App\Mail\SendTicketComment;
use App\Mail\SendTicketInformation;
use App\Mail\SendTicketStatusNotification;
use App\Models\Ticket;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    /**
     * Sends ticket from contacts page to info mail
     *
     * @param  mixed $data
     * @param  mixed $subject
     * @param  mixed $from
     * @param  mixed $to
     * @return void
     */
    public static function sendTicketToEmail($data, $subject, $from, $to)
    {
        Mail::to($to)->send(new SendMail($data, $subject, $from));
    }

    /**
     * sendTicketInformation
     *
     * @param  mixed $data
     * @param  mixed $subject
     * @param  mixed $from
     * @param  mixed $to
     * @param  mixed $user
     * @param  mixed $ticket
     * @return void
     */
    public static function sendTicketInformation($data, $subject, $from, $to, $user, $ticket)
    {
        Mail::to($to)->send(new SendTicketInformation($data, $subject, $from, $user, $ticket));
    }

    /**
     * Sends ticket comment to ticket owners email
     *
     * @param  mixed $data
     * @param  mixed $subject
     * @param  mixed $from
     * @param  mixed $to
     * @param  mixed $user
     * @param  mixed $ticket
     * @return void
     */
    public static function sendTicketComment($data, $subject, $from, $to, $ticketOwner, $user, $ticket)
    {
        Mail::to($to)->send(new SendTicketComment($data, $subject, $from, $ticketOwner, $user, $ticket));
    }

    /**
     * Sends ticket status notification to owners email
     *
     * @param  mixed $subject
     * @param  mixed $from
     * @param  mixed $to
     * @param  mixed $ticketOwner
     * @param  mixed $ticket
     * @param  mixed $user
     * @return void
     */
    public static function sendTicketStatusNotification($subject, $from, $to, $ticketOwner, $ticket, $user)
    {
        Mail::to($to)->send(new SendTicketStatusNotification($subject, $from, $ticketOwner, $ticket, $user));
    }
}
