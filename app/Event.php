<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['title', 'description', 'start', 'end'];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public static function createNew($request)
    {
        $event = new static;

        $event->title = $request->title;
       // $event->description = $request->description;
        $event->start = new Carbon($request->start);
        $event->end = new Carbon($request->end);

        // $event->subject()->associate($request->subject_id);
        // $event->classroom()->associate($request->classroom_id);

        return $event;
    }

    public function saveChanges($request, $event)
    {
        $event->title = $request->title;
        $event->description = $request->description;
        $event->start = new Carbon($request->start);
        $event->end = new Carbon($request->end);

        $event->subject()->associate($request->subject_id);
        $event->classroom()->associate($request->classroom_id);

        return $event->save();
    }
}
