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
                'username' => 'mikcoLoverBoy',
                'is_verified' => 1,
                'password' => Hash::make('lover'),
                'created_at' => now(),
                'email_verified_at' => now(),
            ],
            [
                'email' => 'mikco@bpoc.co.jp',
                'username' => 'karl',
                'is_verified' => 0,
                'password' => Hash::make('karl'),
                'created_at' => null,
                'email_verified_at' => null,
            ],
        ];

        DB::table('users')->insert($users);

    }
}
