<?php

namespace Database\Seeders;

use App\Models\PostLike;
use App\Models\UserPost;
use Illuminate\Database\Seeder;

class LikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $userPosts = UserPost::all();

        $userPosts->each(function ($userPost) {
            $followers = $userPost->user->followers;

            $followers->each(function ($follower) use ($userPost) {
                PostLike::create([
                    'user_id' => $follower->id,
                    'post_id' => $userPost->id,
                ]);
            });
        });
    }
}
