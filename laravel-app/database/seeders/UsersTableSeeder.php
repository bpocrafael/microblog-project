<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Test user data
        $users = [
            [
                'email' => 'jineha8793@apxby.com',
                'username' => 'testUser',
                'is_verified' => 0,
                'password' => Hash::make('test'),
            ],
            [
                'email' => 'test@email.com',
                'username' => 'testUser2',
                'is_verified' => 1,
                'password' => Hash::make('test'),
            ],
        ];

        DB::table('users')->insert($users);

    }
}
