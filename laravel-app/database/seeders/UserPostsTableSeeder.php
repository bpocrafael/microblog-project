<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            ],
            [
                'user_id' => 1,
                'content' => 'Time is gold, spend it wisely :)',
            ],
        ];

        DB::table('user_posts')->insert($user_posts);
    }
}
