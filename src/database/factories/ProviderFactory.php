<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Provider;
use Faker\Generator as Faker;

$factory->define(Provider::class, function (Faker $faker) {
    return [
        'bus_name' => $faker->jobTitle, 
        'code' => $faker->isbn10, 
        'tax_code' => $faker->isbn10, 
        'vat_num' => $faker->isbn10, 
        'email' => $faker->unique()->safeEmail,
        'office_phone' => $faker->phoneNumber, 
        'mobile_phone' => $faker->phoneNumber, 
        'address' => $faker->address, 
        'city' => $faker->city, 
        'post_code' => $faker->postcode, 
        'region' => $faker->country, 
        'category'=> $faker->randomElement(['Generalista', 'Partner', 'Sponsor', 'Docente']),
        'ref_name' => $faker->firstName, 
        'ref_surname'=> $faker->lastName, 
        'ref_title' => $faker->title, 
        'ref_phone' => $faker->phoneNumber, 
        'ref_email' => $faker->unique()->safeEmail
    ];
});
