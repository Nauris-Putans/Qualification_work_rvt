<?php

namespace App\Mail;

use Hashids\Hashids;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendTicketInformation extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $subject;
    public $fromAddress;
    public $fromName;
    public $user;
    public $ticket;
    public $hashids;

    /**
     * Create a new message instance.
     *
     * @param  mixed $data
     * @param  mixed $subject
     * @param  mixed $from
     * @param  mixed $user
     * @param  mixed $ticket
     * @return void
     */
    public function __construct($data, $subject, $from, $user, $ticket)
    {
        $this->data = $data;
        $this->subject = $subject;
        $this->fromAddress = $from['address'];
        $this->fromName = $from['name'];
        $this->user = $user;
        $this->ticket = $ticket;
        $this->hashids = new Hashids(env("HASHIDS"), 10);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.sendTicketInformation')
                    ->from($this->fromAddress, $this->fromName)
                    ->subject($this->subject)
                    ->with(
                        ['data' => $this->data],
                        ['user' => $this->user],
                        ['ticket' => $this->ticket],
                        ['hashids' => $this->hashids]
                    );
    }
}
