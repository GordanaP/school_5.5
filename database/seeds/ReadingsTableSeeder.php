<?php

use App\Lesson;
use Illuminate\Database\Seeder;

class ReadingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lesson = Lesson::first();

        factory(App\Reading::class)->create([
            'lesson_id' => $lesson->id,
            'title' => 'Creative mathematics',
        ]);
    }
}
