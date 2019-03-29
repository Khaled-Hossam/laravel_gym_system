<?php

use Faker\Generator as Faker;

$factory->define(App\City::class, function (Faker $faker) {
    return [
        'country_id' => 4,
        'name' => $faker->word,
    ];
});
