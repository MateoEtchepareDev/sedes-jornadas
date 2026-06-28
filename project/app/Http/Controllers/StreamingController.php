<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Participant;

class StreamingController extends Controller
{
    public function validateCode(Request $request)
    {
        // Validación básica de entrada
        $request->validate([
            'access_code' => 'required|string'
        ]);

        $code = trim($request->input('access_code'));

        // Buscar participante por código
        $participant = Participant::where('access_code', $code)->first();

        // Si no existe, volver con error
        if (!$participant) {
            return back()->withErrors([
                'access_code' => 'Código inválido'
            ])->withInput();
        }

        // Guardar datos en sesión
        session([
            'stream_access'     => true,
            'participant_id'    => $participant->id,
            'participant_name'  => $participant->full_name,
            'participant_email' => $participant->email,
            'participant_dni'   => $participant->dni,
        ]);

        // Redirección final
        return redirect('/transmission');
    }
}