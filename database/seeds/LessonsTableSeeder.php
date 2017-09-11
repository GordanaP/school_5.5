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

        factory(App\Lesson::class)->create([
            'teacher_id' => $user->teacher->id,
            'subject_id' => $subject->id,
            'title' => 'Mathematical Sets'
        ]);
    }
}
