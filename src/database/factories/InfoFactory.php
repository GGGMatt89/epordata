<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class InfoFactory extends Factory
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
            'image_path'=>'/img/infos/default.png'
        ];
    }
}
