<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superadmin = Role::whereName('superadmin')->first();
        $teacher = Role::whereName('teacher')->first();

        User::whereEmail('g@gmail.com')->first()->roles()->attach($superadmin);
        User::whereEmail('d@gmail.com')->first()->roles()->attach($teacher);
    }
}
