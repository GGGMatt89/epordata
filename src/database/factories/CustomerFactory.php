<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Customer;
use Faker\Generator as Faker;

$factory->define(Customer::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name'=> $faker->lastName,
        'title' => $faker->title, 
        'bus_name' => $faker->jobTitle, 
        'cus_code' => $faker->isbn10, 
        'tax_code' => $faker->isbn10, 
        'vat_num' => $faker->isbn10, 
        'email' => $faker->unique()->safeEmail,
        'office_phone' => $faker->phoneNumber, 
        'mobile_phone' => $faker->phoneNumber, 
        'address' => $faker->address, 
        'city' => $faker->city, 
        'post_code' => $faker->postcode, 
        'region' => $faker->country, 
        'rating' => $faker->randomElement(['Standard', 'Vip', 'Prospect']), 
        'category'=> $faker->randomElement(['Fiscale', 'Legale', 'Notaio', 'Lavoro', 'Tecnico', 'Azienda/Ente', 'Altro']),
        'handler'=> $faker->randomElement(['Fiscale', 'Legale']),
        'ref_name' => $faker->firstName, 
        'ref_surname'=> $faker->lastName, 
        'ref_title' => $faker->title, 
        'ref_phone' => $faker->phoneNumber, 
        'ref_email' => $faker->unique()->safeEmail, 
        'profile_id' => factory(\App\Profile::class)
    ];
});
