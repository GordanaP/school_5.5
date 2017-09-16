<?php

namespace App\Http\Controllers;

use App\Http\Requests\LessonRequest;
use App\Lesson;
use App\User;

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
    public function store(LessonRequest $request, User $user)
    {
        // Create a lesson
        $lesson = Lesson::new($request);

        // Assign the lesson to the user
        $newLesson = $user->saveLesson($lesson);

        // Assign the readings to the lesson
        $newLesson->assignReadings($request);

        flash()->success('A new lesson has been created.');
        return redirect()->route('lessons.show', [$user, $newLesson]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, Lesson $lesson)
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
    public function update(LessonRequest $request, User $user, Lesson $lesson)
    {
        // Get the stored lesson
        $lesson = Lesson::make($request, $lesson);

        // Update the lesson
        $updatedLesson = $user->saveLesson($lesson);

        // Update the lesson readings
        $updatedLesson->updateReadings($request, $lesson);

        flash()->success('The lesson has been updated.');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, Lesson $lesson)
    {
        $lesson->deleteLesson($user, $lesson);

        flash()->success('The lesson has been updated.');
        return back();
    }


    public function addPhoto(User $user, Lesson $lesson)
    {
        return $lesson;
    }
}
