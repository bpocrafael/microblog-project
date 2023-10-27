<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserMedia>
 */
class UserMediaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    private static $usedUserIds = [];

    public function definition(): array
    {
        $userId = User::whereNotIn('id', self::$usedUserIds)
        ->inRandomOrder()
        ->first()
        ->id;

        self::$usedUserIds[] = $userId;

        return [
            'user_id' => $userId,
            'file_path' => 'assets/images/coffee-vector-min.webp',
            'file_name' => 'coffee-vector-min.webp',
        ];
    }
}
