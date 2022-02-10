<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CrmMail extends Mailable
{
    use Queueable, SerializesModels;

    public $message;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public function __construct($message, $subject)
    {
        $this->message = $message;
        $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */

    public function build()
    {
        return $this->from(config('mail.from.address'), config('mail.from.name'))
            ->subject($this->subject)
            ->view('emails.crm.email')
            ->with(['content' => $this->message, 'subject' => $this->subject]);
    }
}
