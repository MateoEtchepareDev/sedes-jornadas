<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Participants;

class ParticipantSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            Participants::create([
                'event_id' => $i,
                'full_name' => "Participante $i",
                'dni' => "4000000$i",
                'email' => "participante$i@test.com",
                'role' => 'Asistente',
                'modality' => $i % 2 == 0 ? 'virtual' : 'in_person',
                'payment_status' => 'approved',
                'payment_method' => 'mercado_pago',
                'payment_external_id' => 'MP-' . rand(10000, 99999),
                'qr_token' => $i % 2 != 0 ? uniqid() : null,
                'checkin_confirmed' => $i % 2 != 0,
                'access_code' => $i % 2 == 0 ? strtoupper(uniqid()) : null,
                'questions_completed' => $i % 2 == 0,
                'registered_at' => now(),
                'paid_at' => now(),
            ]);
        }
    }
}