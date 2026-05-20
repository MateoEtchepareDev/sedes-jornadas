<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; 
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       User::create([
        'full_name' => 'Camila',
        'email' => 'camilad923@gmail.com',
        'password_hash' => Hash::make('entrix25'),
        'is_admin' => 1,
    ]); 
    }
}
