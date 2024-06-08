<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Lecture;
use Faker\Generator as Faker;

$factory->define(Lecture::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'beginning'=> $faker->date('Y-m-d', 'now'),
        'end' => $faker->date('Y-m-d', 'now'), 
        'last' => $faker->sentence(3), 
        'place'=> $faker->address,
        'cfp' => $faker->randomFloat(2, 0, 100), 
        'price' => $faker->randomFloat(2, 0, 1000), 
        'description' => $faker->text, 
        'product_id' => factory(\App\Product::class)
    ];
});
