<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Profile;
use Faker\Generator as Faker;

$factory->define(Profile::class, function (Faker $faker) {
    return [
            'first_name' => $faker->firstName,
            'last_name' => $faker->lastName,
            'birth_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'tax_code' => $faker->ean13,
            'mobile_phone' => $faker->phoneNumber,
            'res_address' => $faker->address,
            'res_city' => $faker->city,
            'post_code' => $faker->phoneNumber,
            'area' => $faker->country,
            'image' => '/img/users/default.png',
            'user_id' => factory(\App\User::class)
    ];
});
