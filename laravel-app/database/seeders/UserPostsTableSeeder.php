<?php

namespace Database\Seeders;

use App\Models\UserPost;
use Illuminate\Database\Seeder;

class UserPostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserPost::factory(100)->create();
    }
}
