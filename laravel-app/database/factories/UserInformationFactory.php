<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        $user = User::whereNotIn('id', self::$usedUserIds)
        ->inRandomOrder()
        ->first();

        UserInformationFactory::$usedUserIds[] = $user->id;

        return [
            'user_id' => $user->id,
            'first_name' => fake()->firstName,
            'last_name' => fake()->lastName,
            'middle_name' => fake()->firstName,
            'bio' => fake()->catchPhrase,
            'gender' => fake()->randomElement(['male', 'female', 'other']),
        ];
    }
}
