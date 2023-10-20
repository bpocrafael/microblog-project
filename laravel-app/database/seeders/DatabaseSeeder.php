<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UsersTableSeeder::class,
            UserInformationSeeder::class,
            UserPostsTableSeeder::class,
            UserMediaSeeder::class,
            PostLikesTableSeeder::class,
            PostMediaSeeder::class,
            // PostCommentSeeder::class,
        ]);
    }
}
