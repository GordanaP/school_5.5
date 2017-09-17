<?php

namespace App\Http\Controllers;

use App\Http\Requests\LessonPhotoRequest;
use App\Lesson;
use App\Photo;
use App\User;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * Store the user's lesson newly created resource in storage.
     *
     * @param App\Http\Requests\LessonPhotoRequest $request
     * @param App\Lesson  $lesson
     * @param App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function store(LessonPhotoRequest $request, User $user, Lesson $lesson)
    {
        // Create a photo
        $photo = Photo::makePhoto($request->photo, $user);

        // Save to DB
        if(! $lesson->hasPhoto($photo))
        {
            $lesson->addPhoto($photo);
        }

        return $photo;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function show(Photo $photo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function edit(Photo $photo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function update(LessonPhotoRequest $request, User $user, Lesson $lesson)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Photo $photo)
    {
        $photo->delete();

        flash()->success('The photo has been deleted.');
        return back();
    }
}
