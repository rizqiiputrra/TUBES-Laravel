<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Update or create akun admin
        User::updateOrCreate(
            ['email' => 'admin@event.com'],
            [
                'name'     => 'Admin Event',
                'username' => 'admin',
                'password' => Hash::make('password'),
                'role'     => 'admin',
            ]
        );

        // Update or create akun user
        User::updateOrCreate(
            ['email' => 'user@event.com'],
            [
                'name'     => 'User Biasa',
                'username' => 'user',
                'password' => Hash::make('password'),
                'role'     => 'user',
            ]
        );
    }
}
