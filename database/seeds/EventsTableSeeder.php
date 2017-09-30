<?php

use App\Teacher;
use Illuminate\Database\Seeder;

class EventsTableSeeder extends Seeder
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
        $classroom_id = $subject->pivot->classroom_id;

        factory(App\Event::class)->create([
            'teacher_id' => $teacher->id,
            'title' => 'Test',
            'description' => 'First test',
            'subject_id' => $subject->id,
            'classroom_id' => $classroom_id,
        ]);
    }
}
