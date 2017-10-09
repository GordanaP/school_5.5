<?php

use Faker\Generator as Faker;

$factory->define(App\Holiday::class, function (Faker $faker) {
    return [
        'title' => '',
        'start' => '',
        'end' => '',
        'allDay' => '',
        'holiday' => '',
    ];
});
