<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Info;
use Faker\Generator as Faker;

$factory->define(Info::class, function (Faker $faker) {
    return [
        'title'=>$faker->sentence,
        'excerpt'=>$faker->sentence,
        'body'=>$faker->text,
        'preview_title'=>$faker->sentence,
        'preview_subtitle'=>$faker->sentence,
        'image_path'=>'/img/infos/default.png'
    ];
});
