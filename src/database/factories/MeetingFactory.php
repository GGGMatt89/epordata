<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Meeting;
use Faker\Generator as Faker;

$factory->define(Meeting::class, function (Faker $faker) {
    return [
        'customer_id' => factory(\App\Customer::class),
        'user_id' => factory(\App\User::class),
        'cust_name' => $faker->firstName, 
        'cust_surname' => $faker->lastName, 
        'meet_address' => $faker->sentence, 
        'scheduled_at' => $faker->dateTimeThisMonth('now', 'Europe/Rome'), 
        'notes' => $faker->sentence
    ];
});
