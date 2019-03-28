<?php

use Faker\Generator as Faker;

$factory->define(App\Gym::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'cover_image' => 'https://via.placeholder.com/150x150',
        'city_id' => function () {
            return App\City::inRandomOrder()->first()->id;
        },
        'creator_id' => 2,
    ];
});
