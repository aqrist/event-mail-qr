<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user for accessing Filament panel
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@tridi.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        // Create additional users for testing
        User::create([
            'name' => 'Manajer Event',
            'email' => 'manager@tridi.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Staff',
            'email' => 'staff@tridi.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
    }
}
