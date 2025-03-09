<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'email' => 'admin@gmail.com',
            'user_name' => 'admin',
            'password' => Hash::make('adminpassword'),
            'type' => 'admin',
            'email_verified_at' => '2025-03-04 22:11:21'
        ]);
    }
}
