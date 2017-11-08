<?php

use App\Classroom;
use App\User;
use Illuminate\Database\Seeder;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::whereHas('roles', function ($query) {
            $query->whereName('student');
        })->get();

        $classroom = Classroom::first();

        foreach ($users as $user)
        {
            factory(App\Student::class)->create([
                'user_id' => $user->id,
                'classroom_id' => $classroom->id,
                'name' => $user->name,
            ]);
        }

    }
}
