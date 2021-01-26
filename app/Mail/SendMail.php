<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    public $subject;
    public $fromAddress;
    public $fromName;

    /**
     * Create a new message instance.
     *
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
        return $this->markdown('emails.sendMail')
            ->from($this->fromAddress, $this->fromName)
            ->subject($this->subject)
            ->with(['data' => $this->data]);
    }
}
