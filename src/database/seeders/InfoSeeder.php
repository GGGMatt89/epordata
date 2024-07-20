<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Info;

class InfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Info::factory()
        ->count(20)
        ->create();
    }
}
