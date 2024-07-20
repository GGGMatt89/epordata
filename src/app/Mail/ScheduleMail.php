<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ScheduleMail extends Mailable
{
    use Queueable, SerializesModels;

    public $scheduleArray;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($scheduleArray)
    {
        $this->scheduleArray = $scheduleArray;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.schedule')
                    ->subject('Agenda appuntamenti');
    }
}
