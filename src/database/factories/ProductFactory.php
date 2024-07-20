<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Provider;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
                'name' => fake()->word(),
                'code' => fake()->ean8(),
                'type' => fake()->randomElement(['Editoria', 'Formazione']),
                'category'=> fake()->randomElement(['Vendita beni', 'Archiviazione', 'Editoria', 'Software', 'Formazione']),
                'provider_name' => fake()->company(),
                'provider_id'=> Provider::factory(),
        ];
    }
}
