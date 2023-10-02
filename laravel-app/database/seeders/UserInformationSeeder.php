<?php

namespace Database\Seeders;

use App\Models\UserInformation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserInformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Test userinformation data
        $user_information = [
            [
                'user_id' => 1,
                'first_name' => 'Micko',
                'last_name' => 'Jasareno',
                'middle_name' => 'Pancho',
                'bio' => 'I want to be happy and this is my seeder account in Microblog',
                'gender' => 'male',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'first_name' => 'Karl',
                'last_name' => 'Dela Pena',
                'middle_name' => 'Elanor',
                'bio' => 'Hello World',
                'gender' => 'male',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        UserInformation::insert($user_information);
    }
}
