<?php

use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'date_of_birth'=>$faker->date(),
        'gender'=>'male',

        'verified' => booleanValue(),
        
        'city_id'=>$faker->numberBetween(0,10),
        'gym_id'=>$faker->numberBetween(0,10)
    ];
});
