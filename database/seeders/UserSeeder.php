<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'uuid' => Str::uuid(),
                'first_name' => 'Super',
                'last_name' => 'Admin',
                'username' => 'snpoc_admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('admin123'),
                'profile' => 'default.png',
                'gender' => 'male',
                'email_verified_at' => now(),
                'is_private' => false,
                'is_banned' => false,
            ],
            [
                'uuid' => Str::uuid(),
                'first_name' => 'John',
                'last_name' => 'Doe',
                'username' => 'johndoe',
                'email' => 'john@example.com',
                'password' => Hash::make('password'),
                'profile' => 'default.png',
                'gender' => 'male',
                'email_verified_at' => now(),
                'is_private' => false,
                'is_banned' => false,
            ],
            [
                'uuid' => Str::uuid(),
                'first_name' => 'Jane',
                'last_name' => 'Smith',
                'username' => 'janesmith',
                'email' => 'jane@example.com',
                'password' => Hash::make('password'),
                'profile' => 'default.png',
                'gender' => 'female',
                'email_verified_at' => now(),
                'is_private' => false,
                'is_banned' => false,
            ],
        ];

        foreach ($users as $userData) {
            User::create($userData);
        }
    }
}
