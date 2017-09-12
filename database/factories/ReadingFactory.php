<?php

use App\Lesson;
use Faker\Generator as Faker;

$factory->define(App\Reading::class, function (Faker $faker) {
    return [
        'lesson_id' => function(){
            return factory(Lesson::class)->create()->id;
        },
        'title' => $faker->sentence
    ];
});
