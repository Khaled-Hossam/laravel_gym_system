<?php

use Faker\Generator as Faker;

$factory->define(App\Gym::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'cover_image' => 'uploads/FTR7ozhVsDZ8uKwTQeEr8LXWwjM7s8FFCP610FIy.jpeg',
        'city_id' => function () {
            return App\City::inRandomOrder()->first()->id;
        },
        'creator_id' => 2,
    ];
});
