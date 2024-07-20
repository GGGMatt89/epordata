<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $email_subject;
    public $email_body;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email_subject, $email_body)
    {
        $this->email_subject = $email_subject;
        $this->email_body = $email_body;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.contact')
                    ->subject($this->email_subject);
    }
}
