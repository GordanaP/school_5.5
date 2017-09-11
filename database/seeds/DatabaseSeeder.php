<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    protected $tables = [
        'users',
        'roles',
        'role_user',
        'teachers',
        'subjects',
        'classrooms',
        'subject_teacher',
        'lessons',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->cleanDatabase();

        $this->call(UsersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(RoleUserTableSeeder::class);
        $this->call(TeachersTableSeeder::class);
        $this->call(SubjectsTableSeeder::class);
        $this->call(ClassroomsTableSeeder::class);
        $this->call(SubjectTeacherTableSeeder::class);
        $this->call(LessonsTableSeeder::class);
    }

    /**
     * Truncate tables on each seeding.
     *
     * @return void
     */
    public function cleanDatabase()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        foreach ($this->tables as $table)
        {
            DB::table($table)->truncate();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
