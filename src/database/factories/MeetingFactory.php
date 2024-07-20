<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\User;
use App\Models\Customer;

class MeetingFactory extends Factory
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
            'user_id' => User::factory(),
            'cust_name' => fake()->firstName(),
            'cust_surname' => fake()->lastName(),
            'meet_address' => fake()->sentence(),
            'scheduled_at' => fake()->dateTimeThisMonth('now', 'Europe/Rome'),
            'notes' => fake()->sentence()
        ];
    }
}
