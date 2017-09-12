<?php

namespace App;

use App\Observers\LessonObserver;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = ['subject_id', 'year', 'title', 'topic', 'goals'];

    protected static function boot()
    {
        parent::boot();

        static::observe(LessonObserver::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function readings()
    {
        return $this->hasMany(Reading::class);
    }

    public static function new($request)
    {
        $lesson = new static;

        $lesson->year = $request->year;
        $lesson->title = $request->title;
        $lesson->topic = $request->topic;
        $lesson->goals = $request->goals;

        $lesson->subject()->associate($request->subject_id);

        return $lesson;
    }

    public function assignReadings(array $readings)
    {
        foreach ($readings as $reading)
        {
            $this->readings()->create([
                'title' => $reading
            ]);
        }
    }
}
