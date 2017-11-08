<?php

namespace App\Http\Controllers;

use App\Event;
use App\Http\Requests\EventRequest;
use App\Subject;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class EventController extends Controller
{
    public function __construct()
    {
        // Authenticate
        $this->middleware('auth')->only('index');

        // Authorize
        $this->authorizeResource(Event::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, User $user)
    {
        // The authenticated user can view their calendar only
        $this->authorize('access', $user);

        //Teacher events to be displayed in the calendar
        if ($request->ajax())
        {
            return $user->teacher->events->load('subject', 'classroom');
        }

        return view('events.index')->with([
            'user' => $user->load('teacher'),
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request, User $user)
    {
        $this->authorize('access', $user);

        // Create an event
        $event = Event::createNew($request);

        // Assign the event to the teacher
        $user->saveEvent($event);

        return response([
            'message' => 'A new event has been created.',
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(EventRequest $request, User $user, Event $event)
    {
        // Update the event
        $event->saveChanges($request, $event);

        return response([
            'message' => 'The event has been updated.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, Event $event)
    {
        $event->delete();

        return response([
            'message' => 'The event has been removed from the calendar.',
        ]);
    }

    protected function resourceAbilityMap()
    {
         return [
            'store' => 'create',
            'update'  => 'access',
            'destroy' => 'access',
        ];
    }
}
