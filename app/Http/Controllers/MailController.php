<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\SendMail;
use App\Mail\SendTicketInformation;
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
}
