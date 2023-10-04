<?php

namespace Database\Seeders;

use App\Models\PostLike;
use Illuminate\Database\Seeder;

class PostLikesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Test likes
        $post_likes = [
            [
                'user_id' => 1,
                'post_id' => 1,
            ],
            [
                'user_id' => 1,
                'post_id' => 2,
            ],
        ];

        PostLike::insert($post_likes);
    }
}
