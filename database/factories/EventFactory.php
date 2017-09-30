<?php

use Faker\Generator as Faker;

$factory->define(App\Event::class, function (Faker $faker) {
    return [
        'teacher_id' => function(){
            return factory('App\Teacher')->create()->id;
        },
        'title' => $faker->word,
        'description' => $faker->sentence(1),
        'subject_id' => ' ',
        'classroom_id' => ' ',
        'start' => \Carbon\Carbon::now()->subHours(5),
        'end' => \Carbon\Carbon::now()->subHours(5)->addMinutes(45)
    ];
});
