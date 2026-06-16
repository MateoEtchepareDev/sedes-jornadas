<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Certificate;

class CertificateSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            Certificate::create([
                'participant_id' => $i,
                'event_id' => $i,
                'certificate_url' => "https://misitio.com/certificados/$i.pdf",
                'issued_at' => now(),
            ]);
        }
    }
}