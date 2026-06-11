<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        Users::insert([
            [
                'name' => 'Administrador',
                'email' => 'admin@test.com',
                'password_hash' => Hash::make('123456'),
                'is_admin' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Juan Perez',
                'email' => 'juan@test.com',
                'password_hash' => Hash::make('123456'),
                'is_admin' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Maria Lopez',
                'email' => 'maria@test.com',
                'password_hash' => Hash::make('123456'),
                'is_admin' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Carlos Gomez',
                'email' => 'carlos@test.com',
                'password_hash' => Hash::make('123456'),
                'is_admin' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ana Torres',
                'email' => 'ana@test.com',
                'password_hash' => Hash::make('123456'),
                'is_admin' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}