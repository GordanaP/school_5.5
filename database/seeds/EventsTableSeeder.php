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

        factory(App\Event::class)->create([
            'teacher_id' => $teacher->id,
            'title' => 'Test',
            'description' => 'Second test',
            'subject' => $subject->name,
            'classroom' => 'I-1',
        ]);
    }
}
