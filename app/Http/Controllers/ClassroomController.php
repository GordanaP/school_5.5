<?php

namespace App\Http\Controllers;

use App\Classroom;
use App\Event;
use App\Subject;
use App\Teacher;
use App\User;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function byUser(User $user)
    {
        return view('classrooms.index', compact('user'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, Classroom $classroom, Subject $subject)
    {
        $students = $classroom->students;

        return view('classrooms.show', compact('students'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function edit(Classroom $classroom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Classroom $classroom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classroom $classroom)
    {
        //
    }

    /**
     * Display the teacher classrooms.
     *
     * @return \Illuminate\Http\Response
     */
    public function bySubject(Request $request, $param, User $user, Event $event)
    {
        // Subject identifier is either 'slug' or 'id' (ajax call)
        $subj = Subject::where('id', $param)
            ->orWhere('slug', $param)
            ->firstOrFail();

        $subjects = $user->teacher->teacherSubjects($subj->id);

        return view('classrooms.partials._subjectClassrooms', compact('user', 'subjects', 'event'));
    }
}
