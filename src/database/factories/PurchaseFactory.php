<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Purchase;
use Faker\Generator as Faker;

$factory->define(Purchase::class, function (Faker $faker) {
    return [
        'customer_id' => factory(\App\Customer::class),
        'product_id' => factory(\App\Product::class),
        'type' => $faker->randomElement(['Singolo', 'Abbonamento']),
        'expiration' => $faker->dateTimeThisYear('now', 'Europe/Rome'), 
        'notes' => $faker->sentence
    ];
});
