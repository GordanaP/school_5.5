<?php

use Illuminate\Database\Seeder;

class AssignmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $assignments = ['test', 'quiz', 'homework', 'assignment'];

        foreach ($assignments as $assignment)
        {
            factory(App\Assignment::class)->create([
                'name' => $assignment
            ]);
        }
    }
}
