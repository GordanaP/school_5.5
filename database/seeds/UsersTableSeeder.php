<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ['Gordana', 'Darko', 'Ana', 'Milica', 'Bojana'];

        foreach ($names as $name)
        {
            factory(App\User::class)->create([
                'name' => $name,
                'email' => strtolower(substr($name, 0, 1)) . '@gmail.com',
            ]);
        }
    }
}
