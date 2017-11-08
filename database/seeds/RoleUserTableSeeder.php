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
        //$superadmin = Role::whereName('superadmin')->first();
        $teacher_role = Role::whereName('teacher')->first();
        $student_role = Role::whereName('student')->first();

        $student_users = User::whereIn('email', ['a@gmail.com', 'm@gmail.com', 'b@gmail.com'])->get();
        $teacher_users = User::whereIn('email', ['d@gmail.com', 'g@gmail.com'])->get();

        foreach($teacher_users as $user)
        {
            $user->roles()->attach($teacher_role);
        }

        foreach($student_users as $user)
        {
            $user->roles()->attach($student_role);
        }

    }
}
