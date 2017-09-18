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
        $users = User::whereHas('roles', function ($query) {
            $query->whereName('teacher');
        })->get();

        foreach ($users as $user)
        {
            factory(App\Teacher::class)->create([
                'user_id' => $user->id,
                'first_name' => $user->name,
            ]);
        }
    }
}
