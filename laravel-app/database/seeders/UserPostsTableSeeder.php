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
        $user_posts = [
            [
                'user_id' => 1,
                'content' => 'The quick brown fox jumps over the lazy dog :O',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'content' => 'Time is gold, spend it wisely :)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        UserPost::insert($user_posts);
    }
}
