<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()->firstOrCreate(
            ['email' => 'camilad923@gmail.com'],
            [
                'name' => 'Camila',
                'password_hash' => Hash::make('entrix25'),
                'is_admin' => true,
            ]
        );
    }
}
