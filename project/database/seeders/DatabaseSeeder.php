<?php

namespace Database\Seeders;

use App\Models\Users;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Users::query()->firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password_hash' => Hash::make('password123'),
                'is_admin' => false,
            ]
        );

        $this->call([
            AdminUserSeeder::class,
            EventSeeder::class,
            ParticipantSeeder::class,
            LogSeeder::class,
            UsersSeeder::class,
        ]);
    }
}
