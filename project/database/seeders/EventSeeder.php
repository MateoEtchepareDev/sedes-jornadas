<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            Event::create([
                'title' => "Evento $i",
                'description' => "Descripción del evento $i",
                'price' => rand(1000, 5000),
                'stream_url' => "https://youtube.com/live/evento$i",
                'registration_opens_at' => now(),
                'registration_closes_at' => now()->addDays(10),
                'event_starts_at' => now()->addDays(15),
                'event_ends_at' => now()->addDays(15)->addHours(4),
                'max_participants' => 100,
                'status' => 'published',
            ]);
            
        }
        // Evento ACTIVO (para streaming actual)
        Event::create([
            'title' => "Evento Activo",
            'description' => "Evento actualmente en transmisión",
            'price' => rand(1000, 5000),
            'stream_url' => "https://youtube.com/live/active-event",
            'registration_opens_at' => now()->subDays(5),
            'registration_closes_at' => now()->addDays(5),
            'event_starts_at' => now()->subHour(),
            'event_ends_at' => now()->addHours(4),
            'max_participants' => 100,
            'status' => 'active',
        ]);
    }
}