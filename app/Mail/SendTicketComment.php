<?php

namespace App\Mail;

use Hashids\Hashids;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendTicketComment extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $subject;
    public $fromAddress;
    public $fromName;
    public $ticketOwner;
    public $user;
    public $ticket;
    public $hashids;

    /**
     * Create a new message instance.
     *
     * @param  mixed $data
     * @param  mixed $subject
     * @param  mixed $from
     * @param  mixed $ticketOwner
     * @param  mixed $user
     * @param  mixed $ticket
     * @return void
     */
    public function __construct($data, $subject, $from, $ticketOwner, $user, $ticket)
    {
        $this->data = $data;
        $this->subject = $subject;
        $this->fromAddress = $from['address'];
        $this->fromName = $from['name'];
        $this->ticketOwner = $ticketOwner;
        $this->user = $user;
        $this->ticket = $ticket;
        $this->hashids = new Hashids('WEBcheck', 10);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.sendTicketComment')
                    ->from($this->fromAddress, $this->fromName)
                    ->subject($this->subject)
                    ->with(
                        ['data' => $this->data],
                        ['user' => $this->user],
                        ['ticketOwner' => $this->ticketOwner],
                        ['ticket' => $this->ticket],
                        ['hashids' => $this->hashids],
                    );
    }
}
