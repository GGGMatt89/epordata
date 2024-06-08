<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

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
        // DB::table('users')->insert([
        //     'name' => 'Mattia Fontana',
        //     'email' => 'mattia.fontana@epordata.it',
        //     'password' => Hash::make('Matt22051989'),
        //     'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //     'auth_level' => 'Admin',
        //     'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //     'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        // ]);

        // $this->call([
        //     ProfileSeeder::class,
        // ]);
    }
}
