<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Logs;

class LogSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            Logs::create([
                'user_id' => 1,
                'event_id' => $i,
                'action_type' => 'event_created',
                'actor_type' => 'admin',
                'affected_table' => 'events',
                'entity_id' => $i,
                'before_data' => null,
                'after_data' => json_encode([
                    'title' => "Evento $i"
                ]),
                'created_at' => now(),
            ]);
        }
    }
}