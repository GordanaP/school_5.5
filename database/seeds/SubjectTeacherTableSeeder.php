<?php

use App\Classroom;
use App\Subject;
use App\Teacher;
use App\Teacher;
use App\User;
use Illuminate\Database\Seeder;

class SubjectTeacherTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::whereEmail('d@gmail.com')->first();

        $subject = Subject::whereName('maths')->first();

        $classrooms = Classroom::whereIn('label', ['I-1', 'I-2'])->get();

        foreach ($classrooms as $classroom)
        {
            $user->teacher->subjects()->attach($subject->id, [
                'classroom' => $classroom->label,
            ]);
        }
    }
}
