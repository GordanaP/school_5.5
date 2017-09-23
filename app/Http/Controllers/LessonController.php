<?php

namespace App\Http\Controllers;

use App\Http\Requests\LessonPhotoRequest;
use App\Http\Requests\LessonRequest;
use App\Lesson;
use App\Photo;
use App\User;

class LessonController extends Controller
{
    /**
     * Display the user's listing of resource.
     *
     * @param  App\User $user
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $lessons = $user->teacher->lessons->load('readings', 'subject');

        return view('lessons.index', compact('user', 'lessons'));
    }

    /**
     * Show the form for creating the user's new resource.
     *
     * @param  App\User $user
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
        return view('lessons.create', compact('user'));
    }

    /**
     * Store the user's newly created resource in storage.
     *
     * @param  App\Http\Requests\LessonRequest  $request
     * @param  App\User  $user
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
     * Display the user's specified resource.
     *
     * @param  \App\Lesson  $lesson
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, Lesson $lesson)
    {
        return view('lessons.show', compact('user', 'lesson'));
    }

    /**
     * Show the form for editing the user's specified resource.
     *
     * @param  \App\Lesson  $lesson
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, Lesson $lesson)
    {
        return view('lessons.edit', compact('user', 'lesson'));
    }

    /**
     * Update the user's specified resource in storage.
     *
     * @param  App\Http\Requests\LessonRequest  $request
     * @param  \App\Lesson  $lesson
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(LessonRequest $request, User $user, Lesson $lesson)
    {
        // Get the lesson
        $lesson = Lesson::make($request, $lesson);

        // Update
        $updatedLesson = $user->saveLesson($lesson);

        // Update the readings
        $updatedLesson->updateReadings($request, $lesson);

        flash()->success('The lesson has been updated.');
        return redirect()->route('lessons.show', [$user, $updatedLesson]);
    }

    /**
     * Remove the user's specified resource from storage.
     *
     * @param  \App\Lesson  $lesson
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, Lesson $lesson)
    {
        $lesson->deleteLesson($user, $lesson);

        flash()->success('The lesson has been updated.');
        return back();
    }

    /**
     *  Create a photo for the  user's specified resource.
     *
     * @param App\Http\Requests\LessonPhotoRequest $request
     * @param App\Lesson  $lesson
     * @param App\User  $user
     */
    public function addPhoto(LessonPhotoRequest $request, User $user, Lesson $lesson)
    {
        // Create a photo
        $photo = Photo::makePhoto($request->photo, $user)->with('lesson');

        // Save to DB
        if(! $lesson->hasPhoto($photo))
        {
            $lesson->addPhoto($photo);
        }

        return $photo;
    }

}
