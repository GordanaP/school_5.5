<?php

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
        $user = User::whereEmail('d@gmail.com')->first();
        $subject = $user->teacher->subjects->first();
        $lesson_title = 'Mathematical Sets';

        factory(App\Lesson::class)->create([
            'teacher_id' => $user->teacher->id,
            'subject_id' => $subject->id,
            'title' => $lesson_title
        ]);
    }
}
