<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'bendahara@example.com'],
            [
                'name' => 'Bendahara',
                'password' => Hash::make('password123'),
                'role' => 'bendahara',
            ]
        );

        User::updateOrCreate(
            ['email' => 'walikelas@example.com'],
            [
                'name' => 'Wali Kelas',
                'password' => Hash::make('password123'),
                'role' => 'walikelas',
            ]
        );

        User::updateOrCreate(
            ['email' => 'siswa@example.com'],
            [
                'name' => 'Siswa',
                'password' => Hash::make('password123'),
                'role' => 'siswa',
            ]
        );
    }
}