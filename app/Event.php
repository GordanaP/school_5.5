<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['title', 'description', 'classroom', 'start', 'end'];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public static function createNew($request)
    {
        $event = new static;

        $event->title = $request->title;
        $event->description = $request->description;
        $event->classroom = $request->classroom;
        $event->start = new Carbon($request->date .' '.$request->start);
        $event->end = new Carbon($request->date .' '.$request->end);

        $event->subject()->associate($request->subject_id);

        return $event;
    }
}
