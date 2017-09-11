<?php

use App\Services\Utilities\Year;
use Faker\Generator as Faker;

$factory->define(App\Lesson::class, function (Faker $faker) {
    return [
        'teacher_id' => function(){
            return factory(App\Teacher::class)->create()->id;
        },
        'subject_id' => function(){
            return factory(App\Subject::class)->create()->id;
        },
        'year' => array_keys(Year::all())[0],
        'title' => $faker->sentence
    ];
});
