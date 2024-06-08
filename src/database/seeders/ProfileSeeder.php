<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
        * ROOT user profile
        *
        */
        DB::table('profiles')->insert([
            'first_name' => 'Mattia',
            'last_name' => 'Fontana',
            'user_id' => 1,
        ]);
    }
}
