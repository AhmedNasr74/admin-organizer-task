<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;

class CheckPendingEvents
{
    use Dispatchable;

    public $events;

    public function __construct($events)
    {
        $this->events = $events;
    }
}
