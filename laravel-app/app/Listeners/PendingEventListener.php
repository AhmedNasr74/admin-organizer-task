<?php

namespace App\Listeners;

use App\Events\CheckPendingEvents;
use App\Http\Requests\AdminAuthLoginRequest;
use App\Mail\PendingEventsMail;
use App\User;
use Illuminate\Support\Facades\Mail;

class PendingEventListener
{
    public function __construct()
    {
        //
    }

    public function handle(CheckPendingEvents $event)
    {
        $admins = User::pluck('email')->toArray();
        Mail::to($admins)->send(new PendingEventsMail($event->events));
    }
}
