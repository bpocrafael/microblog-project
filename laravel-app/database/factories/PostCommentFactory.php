<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserPost;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PostComment>
 */
class PostCommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'comment' => fake()->text,
            'user_id' => User::inRandomOrder()->first()->id,
            'post_id' => UserPost::inRandomOrder()->first()->id,
        ];
    }
}
