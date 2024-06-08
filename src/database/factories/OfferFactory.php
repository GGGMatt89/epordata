<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Offer;
use Faker\Generator as Faker;

$factory->define(Offer::class, function (Faker $faker) {
    return [
        'title'=>$faker->sentence,
        'excerpt'=>$faker->sentence,
        'body'=>$faker->text,
        'preview_title'=>$faker->sentence,
        'preview_subtitle'=>$faker->sentence,
        'beginning'=>$faker->date('Y-m-d', '+2 months'),
        'expiration'=>$faker->date('Y-m-d', '+2 months'),
        'image_path'=>'/img/offers/default.png'
    ];
});
