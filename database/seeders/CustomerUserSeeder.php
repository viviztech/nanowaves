<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CustomerUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create test customer user
        User::firstOrCreate(
            ['email' => 'customer@nanowaves.com'],
            [
                'name' => 'Test Customer',
                'password' => Hash::make('customer123'),
                'is_admin' => false,
            ]
        );

        // Create additional test customers
        User::firstOrCreate(
            ['email' => 'john.doe@example.com'],
            [
                'name' => 'John Doe',
                'password' => Hash::make('password123'),
                'is_admin' => false,
            ]
        );

        User::firstOrCreate(
            ['email' => 'jane.smith@example.com'],
            [
                'name' => 'Jane Smith',
                'password' => Hash::make('password123'),
                'is_admin' => false,
            ]
        );
    }
}

