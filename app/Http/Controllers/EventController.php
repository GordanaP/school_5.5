<?php

namespace App\Http\Controllers;

use App\Event;
use App\Subject;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, User $user)
    {
        //Teacher events to be displayed in the calendar
        if ($request->ajax())
        {
            return $user->teacher->events;
        }

        return view('events.index')->with([
            'user' => $user->load('teacher'),
        ]);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        // Create an event
        $event = Event::createNew($request);

        // Assign the event to the teacher
        $user->assignEvent($event);

        return response([
            'message' => 'A new event has been created.',
            'event' => $event
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }

    public function ajaxClassrooms(Subject $subject, User $user)
    {
        return $user;
        return view('calendars.partials._ajaxClassrooms', compact('user', 'subject'));
    }

}
