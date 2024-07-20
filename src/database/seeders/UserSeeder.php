<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
        * ROOT user
        *
        */
        User::factory()->hasProfile([
            'first_name' => 'Mattia',
            'last_name' => 'Fontana',
            'birth_date' => '1989-05-22',
            'res_address' => 'Lungo Po Antonelli 133',
            'res_city' => 'Torino',
            'post_code' => 10153,
            'area' => 'Torino',
        ])->create([
            'name' => 'Mattia Fontana',
            'email' => 'mattia.fontana@epordata.it',
            'password' => Hash::make('Matt22051989'),
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'auth_level' => 'Admin',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        User::factory()
            ->hasProfile(function (array $attributes, User $user) {
                return ['first_name' => $user->name];
            })
            ->count(10)
            ->create();

    }
}
