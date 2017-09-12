<?php

use App\Classroom;
use App\Subject;
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

        $subject1 = Subject::whereName('maths')->first();
        $classrooms1 = Classroom::whereIn('label', ['I-1', 'I-2'])->get();

        $subject2 = Subject::whereName('arts & culture')->first();
        $classrooms2 = Classroom::whereIn('label', ['II-1', 'II-2'])->get();

        foreach ($classrooms1 as $classroom)
        {
            $user->teacher->subjects()->attach($subject1->id, [
                'classroom' => $classroom->label,
            ]);
        }

        foreach ($classrooms2 as $classroom)
        {
            $user->teacher->subjects()->attach($subject2->id, [
                'classroom' => $classroom->label,
            ]);
        }
    }
}
