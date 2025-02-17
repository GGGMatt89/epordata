<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\News;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        News::factory()
        ->count(20)
        ->create();
    }
}
