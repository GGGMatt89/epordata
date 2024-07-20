<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OfferFactory extends Factory
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
            'beginning'=>fake()->date('Y-m-d', '+2 months'),
            'expiration'=>fake()->date('Y-m-d', '+2 months'),
            'image_path'=>'/img/offers/default.png'
        ];
    }
}
