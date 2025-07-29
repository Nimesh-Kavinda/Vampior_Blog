<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'System Administrator',
                'email' => 'admin@vampiorblog.com',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Alex Morgan',
                'email' => 'alex.morgan@example.com',
                'password' => Hash::make('password123'),
                'role' => 'editor',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Emma Rodriguez',
                'email' => 'emma.rodriguez@example.com',
                'password' => Hash::make('password123'),
                'role' => 'editor',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Jordan Blake',
                'email' => 'jordan.blake@example.com',
                'password' => Hash::make('password123'),
                'role' => 'reader',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'John Reader',
                'email' => 'reader@example.com',
                'password' => Hash::make('password123'),
                'role' => 'reader',
                'email_verified_at' => now(),
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
