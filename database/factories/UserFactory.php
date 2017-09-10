<?php

use Faker\Generator as Faker;


$factory->define(App\User::class, function (Faker $faker) {
    static $password;

    $name = 'Gordana';

    return [
        'name' => $name,
        'email' => substr($name, 0, 1) . '@gmail.com',
        'password' => $password ?: $password = bcrypt('123456'),
        'remember_token' => str_random(10),
    ];
});
