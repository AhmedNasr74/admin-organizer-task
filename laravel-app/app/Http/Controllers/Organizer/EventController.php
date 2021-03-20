<?php

namespace App\Http\Controllers\Organizer;

use App\Event;
use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use App\Http\Resources\EventResource;
use App\Http\Resources\EventsResource;
use Illuminate\Http\Request;

class EventController extends Controller
{

    public function index(Request $request)
    {
        $q = auth()->guard('organizers')->user()->events()->orderByDesc('created_at');
        if ($request->get('name') != '')
            $q->where('name' , 'LIKE' , '%' . $request->get('name') .'%');
        if ($request->get('status') != '')
            $q->where('status' , $request->get('status'));

        $events = $q->get();
        return $this->responseData(new EventsResource($events));

    }


    public function store(EventRequest $request)
    {
        auth()->guard('organizers')->user()->events()->create($request->validated());
        return $this->responseSuccess('Event added successfully , Wait for admin approval');
    }


    public function show($id)
    {
       $event =  auth()->guard('organizers')->user()->events()->find($id);
       if (!$event)
           return $this->responseError('Event Not Found');
       return  $this->responseData(new EventResource($event));
    }


    public function update(EventRequest $request, $id)
    {
        $event =  auth()->guard('organizers')->user()->events()->find($id);
        if (!$event)
            return $this->responseError('Event Not Found');
        $event->update($request->validated());
        return $this->responseSuccess('Event updated successfully , Wait for admin approval');
    }


    public function destroy($id)
    {
        //
    }
}
