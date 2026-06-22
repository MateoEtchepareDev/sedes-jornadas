<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Barryvdh\DomPDF\Facade\Pdf;

class CertificateController extends Controller
{
    public function show(Participant $participant)
    {
        $participant->load('event');

        if (! $participant->canDownloadCertificate()) {
            abort(403, 'Este participante no cumple las condiciones para acceder al certificado.');
        }

        $pdf = Pdf::loadView('certificates.template', compact('participant'));

        return $pdf->stream('certificate-' . $participant->uuid . '.pdf');
    }
}