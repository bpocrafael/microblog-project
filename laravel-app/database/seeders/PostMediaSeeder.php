<?php

namespace Database\Seeders;

use App\Models\PostMedia;
use Illuminate\Database\Seeder;

class PostMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PostMedia::factory(20)->create();
    }
}
