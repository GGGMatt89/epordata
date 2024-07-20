<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;


class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'birth_date' => fake()->date($format = 'Y-m-d', $max = 'now'),
            'tax_code' => fake()->ean13(),
            'mobile_phone' => fake()->phoneNumber(),
            'res_address' => fake()->address(),
            'res_city' => fake()->city(),
            'post_code' => fake()->phoneNumber(),
            'area' => fake()->country(),
            'image' => '/img/users/default.png',
        ];
    }
}
