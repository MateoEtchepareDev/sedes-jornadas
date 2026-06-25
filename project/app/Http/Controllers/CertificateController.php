<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Barryvdh\DomPDF\Facade\Pdf;

class CertificateController extends Controller
{
    public function show($uuid)
    {
        // Fetch participant by UUID from participants table
        $participant = Participant::where('uuid', $uuid)->firstOrFail();
        
        $participant->load('event');

        if (!$participant->canDownloadCertificate()) {
            abort(403, 'Este participante no cumple las condiciones para acceder al certificado.');
        }

        // Generate PDF on-demand
        $pdf = Pdf::loadView('pages.public.certificates.template', compact('participant'));

        return $pdf->stream('certificate-' . $participant->uuid . '.pdf');
    }
}