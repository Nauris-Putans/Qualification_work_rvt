<?php

namespace App\Mailers;

use App\Models\Ticket;
use App\User;
use Illuminate\Contracts\Mail\Mailer;

class AppMailer
{
    protected $mailer;
    protected $fromAddress = 'webcheck@gmail.com';
    protected $fromName = 'Support Ticket';
    protected $to;
    protected $subject;
    protected $view;
    protected $data = [];

    /**
     * AppMailer constructor.
     * @param $mailer
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Sends ticket from contacts page to info mail
     *
     * @param $data
     */
    public function sendTicketToEmail($data)
    {
        $this->to = 'info.webcheck@gmail.com';
        $this->fromAddress = $data['email'];
        $this->fromName = $data['fullname'];
        $this->subject = $data['title'];
        $this->view = 'emails.ticket_to_email';
        $this->data = compact('data');
        return $this->deliver();
    }

    /**
     * Sends ticket information to users email
     *
     * @param $user
     * @param Ticket $ticket
     */
    public function sendTicketInformation($user, Ticket $ticket)
    {
        $this->to = $user->email;
        $this->subject = "[Ticket ID: $ticket->ticket_id] $ticket->title";
        $this->view = 'emails.ticket_info';
        $this->data = compact('user', 'ticket');
        return $this->deliver();
    }

    /**
     * Sends ticket comment to ticket owners email
     *
     * @param $ticketOwner
     * @param $user
     * @param Ticket $ticket
     * @param $comment
     */
    public function sendTicketComments($ticketOwner, $user, Ticket $ticket, $comment)
    {
        $this->to = $ticketOwner->email;
        $this->subject = "RE: $ticket->title (Ticket ID: $ticket->ticket_id)";
        $this->view = 'emails.ticket_comments';
        $this->data = compact('ticketOwner', 'user', 'ticket', 'comment');
        return $this->deliver();
    }

    /**
     * Sends ticket status notification to owners email
     *
     * @param $ticketOwner
     * @param Ticket $ticket
     */
    public function sendTicketStatusNotification($ticketOwner, Ticket $ticket)
    {
        $this->to = $ticketOwner->email;
        $this->subject = "RE: $ticket->title (Ticket ID: $ticket->ticket_id)";
        $this->view = 'emails.ticket_status';
        $this->data = compact('ticketOwner', 'ticket');
        return $this->deliver();
    }

    /**
     * Deliver function
     */
    public function deliver()
    {
        $this->mailer->send($this->view, $this->data, function($message)
        {
            $message->from($this->fromAddress, $this->fromName)
                ->to($this->to)->subject($this->subject);
        });
    }
}
