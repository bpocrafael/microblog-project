<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserPost;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PostMedia>
 */
class PostMediaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'post_id' => UserPost::inRandomOrder()->first()->id,
            'file_path' => 'images/1epXFo9FFqeB10Sm1NX63MLwnmzmQY7IG9DAng3k.png',
        ];
    }
}
