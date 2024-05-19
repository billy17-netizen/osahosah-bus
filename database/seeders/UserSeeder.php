<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert(
            [
                [
                    'name' => 'Admin',
                    'email' => 'admin@gmail.com',
                    'mobile_number' => '123456789',
                    'city' => 'Jawa Tenggah',
                    'state' => 'Semarang',
                    'address' => 'Jl. Raya Semarang',
                    'life_insuranse' => '0',
                    'role' => 'admin',
                    'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                ],
                [
                    'name' => 'User',
                    'email' => 'user@gmail.com',
                    'mobile_number' => '987654321',
                    'city' => 'Jawa Tenggah',
                    'state' => 'Salatiga',
                    'address' => 'Jl. Raya Salatiga',
                    'life_insuranse' => '1',
                    'role' => 'user',
                    'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                ],
            ]
        );
    }
}
