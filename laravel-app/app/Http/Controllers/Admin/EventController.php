<?php

namespace App\Http\Controllers\Admin;

use App\Event;
use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Http\Resources\EventsResource;
use Illuminate\Http\Request;

class EventController extends Controller
{

    public function index(Request $request)
    {

        $q = Event::with('organizer')->orderByDesc('id');
        if ($request->get('name') != '')
            $q->where('name' , 'LIKE' , '%' . $request->get('name') .'%');
        if ($request->get('status') != '')
            $q->where('status' , $request->get('status'));
        $events = $q->get();

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
