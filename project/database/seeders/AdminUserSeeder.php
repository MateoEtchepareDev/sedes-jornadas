<?php

namespace Database\Seeders;

use App\Models\Users;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
<<<<<<< HEAD
       User::create([
        'name' => 'Camila',
        'email' => 'camilad923@gmail.com',
        'password' => Hash::make('entrix25'),
        'is_admin' => 1,
    ]); 
=======
        Users::query()->firstOrCreate(
            ['email' => 'camilad923@gmail.com'],
            [
                'name' => 'Camila',
                'password_hash' => Hash::make('entrix25'),
                'is_admin' => true,
            ]
        );
>>>>>>> origin/main
    }
}
