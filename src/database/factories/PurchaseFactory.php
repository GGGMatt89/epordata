<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Customer;
use App\Models\Product;


class PurchaseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => Customer::factory(),
            'product_id' => Product::factory(),
            'type' => fake()->randomElement(['Singolo', 'Abbonamento']),
            'expiration' => fake()->dateTimeThisYear('now', 'Europe/Rome'),
            'notes' => fake()->sentence()
        ];
    }
}
