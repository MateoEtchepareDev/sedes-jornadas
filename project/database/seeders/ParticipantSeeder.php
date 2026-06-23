<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Participant;
use Illuminate\Support\Str;

class ParticipantSeeder extends Seeder
{
    public function run(): void
    {
        // create participants for multiple events
        for ($eventId = 1; $eventId <= 5; $eventId++) {

            for ($i = 1; $i <= 10; $i++) {

                $isVirtual = $i % 2 === 0;

                $paymentApproved = true;

                $participant = Participant::create([
                    'event_id' => $eventId,
                    'uuid' => Str::uuid(), // FIX: unique per participant

                    'full_name' => "Participant {$eventId}-{$i}",
                    'dni' => (string) (40000000 + ($eventId * 100 + $i)),
                    'email' => "participant{$eventId}_{$i}@test.com",
                    'role' => 'attendee',

                    'modality' => $isVirtual ? 'virtual' : 'in_person',

                    'payment_status' => $paymentApproved ? 'approved' : 'pending',
                    'payment_method' => 'mercado_pago',
                    'payment_external_id' => 'MP-' . strtoupper(Str::random(8)),

                    // IN-PERSON LOGIC
                    'qr_token' => $isVirtual ? null : Str::random(32),
                    'checkin_confirmed' => $isVirtual ? null : (bool) random_int(0, 1),

                    // VIRTUAL LOGIC
                    'access_code' => $isVirtual ? strtoupper(Str::random(10)) : null,
                    'questions_completed' => $isVirtual ? (bool) random_int(0, 1) : null,

                    'registered_at' => now()->subDays(random_int(1, 30)),
                    'paid_at' => now()->subDays(random_int(0, 10)),
                ]);
            }
        }
    }
}