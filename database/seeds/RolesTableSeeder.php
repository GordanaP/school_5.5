<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ['student', 'parent', 'teacher', 'admin', 'superadmin'];

        foreach ($names as $name)
        {
            factory(App\Role::class)->create([
                'name' => $name
            ]);
        }
    }
}
