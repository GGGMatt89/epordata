<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\News;
use Faker\Generator as Faker;

$factory->define(News::class, function (Faker $faker) {
    return [
        'title'=>$faker->sentence,
        'excerpt'=>$faker->sentence,
        'body'=>$faker->text,
        'preview_title'=>$faker->sentence,
        'preview_subtitle'=>$faker->sentence,
        'date'=>$faker->date('Y-m-d', '+1 months'),
        'image_path'=>'/img/news/default.png'
    ];
});
