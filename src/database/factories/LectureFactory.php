<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

class LectureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'beginning'=> fake()->date('Y-m-d', 'now'),
            'end' => fake()->date('Y-m-d', 'now'),
            'last' => fake()->sentence(3),
            'place'=> fake()->address(),
            'cfp' => fake()->randomFloat(2, 0, 100),
            'price' => fake()->randomFloat(2, 0, 1000),
            'description' => fake()->text(),
            'product_id' => Product::factory()
        ];
    }
}
