<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class PendingEventsMail extends Mailable
{
    private $events;

    public function __construct($events)
    {
        $this->events = $events;
    }

    public function build()
    {
        return $this->view('emails.pending-events')->subject("Pending Events Remainder")

            ->with('events',$this->events);
    }
}
