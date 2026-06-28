<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Participant;
use App\Models\Event;
use Illuminate\Support\Str;

class ParticipantSeeder extends Seeder
{
    public function run(): void
    {
        // Create or get a test event
        $event = Event::first() ?? Event::create([
            'title' => 'Jornada de Prueba',
            'description' => 'Evento de prueba para validar certificados',
            'price' => 0,
            'registration_opens_at' => now()->subDays(10),
            'registration_closes_at' => now()->addDays(5),
            'event_starts_at' => now()->subDays(1),
            'event_ends_at' => now(),
            'max_participants' => 100,
            'status' => 'finished',
        ]);

        // 1. ELIGIBLE participant (in_person, payment approved, checkin confirmed)
        Participant::create([
            'event_id' => $event->id,
            'uuid' => Str::uuid(),
            'full_name' => 'Juan Pérez García',
            'dni' => '12345678',
            'email' => 'juan@example.com',
            'role' => 'attendee',
            'modality' => 'in_person',
            'payment_status' => 'approved',
            'payment_method' => 'mercado_pago',
            'access_code' => Str::random(20),
            'payment_external_id' => 'MP-' . strtoupper(Str::random(8)),
            'qr_token' => Str::random(32),
            'checkin_confirmed' => true,
            'registered_at' => now()->subDays(5),
            'paid_at' => now()->subDays(5),
        ]);

        // 2. NOT ELIGIBLE (in_person, payment approved, but NO checkin)
        Participant::create([
            'event_id' => $event->id,
            'uuid' => Str::uuid(),
            'full_name' => 'María López Rodríguez',
            'dni' => '87654321',
            'email' => 'maria@example.com',
            'role' => 'attendee',
            'modality' => 'in_person',
            'payment_status' => 'approved',
            'payment_method' => 'mercado_pago',
            'access_code' => Str::random(20),
            'payment_external_id' => 'MP-' . strtoupper(Str::random(8)),
            'qr_token' => Str::random(32),
            'checkin_confirmed' => false,
            'registered_at' => now()->subDays(5),
            'paid_at' => now()->subDays(5),
        ]);

        // 3. NOT ELIGIBLE (virtual, payment still pending)
        Participant::create([
            'event_id' => $event->id,
            'uuid' => Str::uuid(),
            'full_name' => 'Carlos González Silva',
            'dni' => '11111111',
            'email' => 'carlos@example.com',
            'role' => 'attendee',
            'modality' => 'virtual',
            'payment_status' => 'pending',
            'payment_method' => 'mercado_pago',
            'access_code' => Str::random(20),
            'questions_completed' => null,
            'registered_at' => now()->subDays(2),
            'paid_at' => null,
        ]);
    }
}