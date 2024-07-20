<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProviderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'bus_name' => fake()->jobTitle(),
            'code' => fake()->isbn10(),
            'tax_code' => fake()->isbn10(),
            'vat_num' => fake()->isbn10(),
            'email' => fake()->unique()->safeEmail(),
            'office_phone' => fake()->phoneNumber(),
            'mobile_phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'city' => fake()->city(),
            'post_code' => fake()->postcode(),
            'region' => fake()->country(),
            'category'=> fake()->randomElement(['Generalista', 'Partner', 'Sponsor', 'Docente']),
            'ref_name' => fake()->firstName(),
            'ref_surname'=> fake()->lastName(),
            'ref_title' => fake()->title(),
            'ref_phone' => fake()->phoneNumber(),
            'ref_email' => fake()->unique()->safeEmail()
        ];
    }
}
