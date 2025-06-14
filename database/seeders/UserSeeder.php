<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            ['name' => 'Shruti', 'email' => 'shruti@example.com'],
            ['name' => 'Taylor', 'email' => 'taylor@example.com'],
            ['name' => 'John', 'email' => 'john@example.com', 'role' => 'instructor'],
            ['name' => 'Admin', 'email' => 'admin@example.com', 'role' => 'admin'],
        ];

        foreach ($users as $user) {
            User::factory()->create($user);
        }

        // Random users
        User::factory()->count(10)->create();
        // Random instructors
        User::factory()->count(10)->create(['role' => 'instructor']);
    }
}
