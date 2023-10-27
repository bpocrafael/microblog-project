<?php

namespace Database\Seeders;

use App\Models\UserMedia;
use Illuminate\Database\Seeder;

class UserMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserMedia::factory(20)->create();
    }
}
