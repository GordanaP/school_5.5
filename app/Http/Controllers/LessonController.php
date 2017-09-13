<?php

namespace App\Http\Controllers;

use App\Lesson;
use App\User;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $lessons = $user->teacher->lessons->load('readings', 'subject');

        return view('lessons.index', compact('user', 'lessons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
        return view('lessons.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        // Create a lesson
        $lesson = Lesson::new($request);

        // Assign the lesson to the user
        $newLesson = $user->saveLesson($lesson);

        // Assign readings to the lesson
        if($request->readings)
        {
            $newLesson->assignReadings($request);
        }

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function show(Lesson $lesson)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, Lesson $lesson)
    {
        return view('lessons.edit', compact('user', 'lesson'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user, Lesson $lesson)
    {
        // Get the stored lesson
        $lesson = Lesson::make($request, $lesson);

        // Update the lesson
        $updatedLesson = $user->saveLesson($lesson);

        // Update the lesson readings
        if($request->readings)
        {
            $updatedLesson->updateReadings($request, $lesson);
        }

        return redirect()->route('lessons.edit', [$user, $lesson]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lesson $lesson)
    {
        //
    }
}
