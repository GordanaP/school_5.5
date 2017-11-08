<?php

use App\Teacher;
use App\User;
use Illuminate\Database\Seeder;

class LessonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teacher = Teacher::first();
        $subject = $teacher->subjects->first();
        $lesson_title = 'Mathematical Sets';

        factory(App\Lesson::class)->create([
            'teacher_id' => $teacher->id,
            'subject_id' => $subject->id,
            'title' => $lesson_title
        ]);
    }
}
