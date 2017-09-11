<?php

use App\User;
use Illuminate\Database\Seeder;

class TeachersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teachers = User::whereHas('roles', function ($query) {
            $query->where('name', '=', 'teacher');
        })->get();

        foreach ($teachers as $teacher)
        {
            factory(App\Teacher::class)->create([
                'user_id' => $teacher->id,
            ]);
        }
    }
}
