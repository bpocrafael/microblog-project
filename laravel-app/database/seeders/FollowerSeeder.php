<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class FollowerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $users = User::all();

        $users->each(function ($user) use ($users) {
            $user->followers()->attach($users->except($user->id)->random(rand(1, count($users) - 1))->pluck('id'));
        });
    }
}
