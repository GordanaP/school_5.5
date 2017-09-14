<?php

namespace App\Traits;

trait LessonCreate
{
    protected static function new($request)
    {
        $lesson = new static;

        $lesson->year = $request->year;
        $lesson->title = $request->title;
        $lesson->topic = $request->topic;
        $lesson->goals = $request->goals;

        $lesson->subject()->associate($request->subject_id);

        return $lesson;
    }

    protected static function make($request, $lesson)
    {
        $lesson->year = $request->year;
        $lesson->title = $request->title;
        $lesson->topic = $request->topic;
        $lesson->goals = $request->goals;

        $lesson->subject()->associate($request->subject_id);

        return $lesson;
    }

    public function assignReadings($request)
    {
        if (count($request->readings) > 0)
        {
            foreach ($request->readings as $reading)
            {
                $this->readings()->create([
                    'title' => $reading
                ]);
            }
        }
    }

    public function updateReadings($request, $lesson)
    {
        if (count($lesson->readings) > 0)
        {
             $lesson->readings->each(function ($item, $key) {
                $item->delete();
            });
        }

        if(count($request->readings) > 0)
        {
            $this->assignReadings($request);
        }

    }

    public function deleteLesson($user, $lesson)
    {
        $lesson = $user->teacher->lessons()->whereSlug($lesson->slug)->first();

        $lesson->delete();
    }
}