<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
            'name' => $faker->word,
            'code' => $faker->ean8,
            'type' => $faker->randomElement(['Editoria', 'Formazione']),
            'category'=> $faker->randomElement(['Vendita beni', 'Archiviazione', 'Editoria', 'Software', 'Formazione']),
            'provider_name' => $faker->company,
            'provider_id'=> factory(\App\Provider::class),
    ];
});
