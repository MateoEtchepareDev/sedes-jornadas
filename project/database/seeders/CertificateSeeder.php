<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Certificates;

class CertificateSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            Certificates::create([
                'participant_id' => $i,
                'event_id' => $i,
                'certificate_url' => "https://misitio.com/certificados/$i.pdf",
                'issued_at' => now(),
            ]);
        }
    }
}