<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Profile;

class CustomerFactory extends Factory
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
            'last_name'=> fake()->lastName(),
            'title' => fake()->title(),
            'bus_name' => fake()->jobTitle(),
            'cus_code' => fake()->isbn10(),
            'tax_code' => fake()->isbn10(),
            'vat_num' => fake()->isbn10(),
            'email' => fake()->unique()->safeEmail(),
            'office_phone' => fake()->phoneNumber(),
            'mobile_phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'city' => fake()->city(),
            'post_code' => fake()->postcode(),
            'region' => fake()->country(),
            'rating' => fake()->randomElement(['Standard', 'Vip', 'Prospect']),
            'category'=> fake()->randomElement(['Fiscale', 'Legale', 'Notaio', 'Lavoro', 'Tecnico', 'Azienda/Ente', 'Altro']),
            'handler'=> fake()->randomElement(['Fiscale', 'Legale']),
            'ref_name' => fake()->firstName(),
            'ref_surname'=> fake()->lastName(),
            'ref_title' => fake()->title(),
            'ref_phone' => fake()->phoneNumber(),
            'ref_email' => fake()->unique()->safeEmail(),
            // 'profile_id' => Profile::factory()
        ];
    }
}
