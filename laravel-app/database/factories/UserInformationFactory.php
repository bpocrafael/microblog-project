<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserInformation>
 */
class UserInformationFactory extends Factory
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
            'first_name' => fake()->firstName,
            'last_name' => fake()->lastName,
            'middle_name' => fake()->firstName,
            'bio' => Str::random(10),
            'gender' => fake()->randomElement(['male', 'female', 'other']),
        ];
    }
}
