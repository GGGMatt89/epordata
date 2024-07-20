<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'=>fake()->sentence(),
            'excerpt'=>fake()->sentence(),
            'body'=>fake()->text(),
            'preview_title'=>fake()->sentence(),
            'preview_subtitle'=>fake()->sentence(),
            'date'=>fake()->date('Y-m-d', '+1 months'),
            'image_path'=>'/img/news/default.png'
        ];
    }
}
