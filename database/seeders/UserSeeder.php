<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'     => 'Admin Labung',
            'email'    => 'admin@gmail.com',
            'password' => Hash::make('password123'), // Password di-encrypt
            'role'     => 'admin',
        ]);
        User::create([
            'name'     => 'Lebah Cantik',
            'email'    => 'user@gmail.com',
            'password' => Hash::make('password123'),
            'role'     => 'user',
        ]);
    }
}
