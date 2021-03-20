<?php

namespace App\Http\Controllers\Admin;

use App\Event;
use App\Events\CheckPendingEvents;
use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Http\Resources\EventsResource;
use Illuminate\Notifications\Messages\MailMessage;

class EventController extends Controller
{

    public function index()
    {

        $events = Event::with('organizer')->orderByDesc('id')->get();
        event(new CheckPendingEvents($events));

        return $this->responseData(new EventsResource($events));
    }

    public function show($id)
    {
        $event =  Event::with('organizer')->find($id);
        if (!$event)
            return $this->responseError('Event Not Found');
        return  $this->responseData(new EventResource($event));
    }

    public function change_status($id){
        $event =  Event::with('organizer')->find($id);
        if (!$event)
            return $this->responseError('Event Not Found');
        if ($event->status == 1)
            return $this->responseSuccess('Event already has been approved before');
        $event->update(['status' => 1]);
        return $this->responseSuccess('Event has approved');
    }
}
