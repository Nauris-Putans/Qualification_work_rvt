<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendSubscription extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $subject;
    public $fromAddress;
    public $fromName;

    /**
     * Create a new message instance.
     *
     * @param  mixed $data
     * @param  mixed $subject
     * @param  mixed $from
     * @return void
     */
    public function __construct($data, $subject, $from)
    {
        $this->data = $data;
        $this->subject = $subject;
        $this->fromAddress = $from['address'];
        $this->fromName = $from['name'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.sendSubscription')
                    ->from($this->fromAddress, $this->fromName)
                    ->subject($this->subject)
                    ->with(['data' => $this->data]);
    }
}
