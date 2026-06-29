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
      
        $deviceToken = $request->participant_local;

        // Si ya está usado y el dispositivo es distinto
        if (
            $participant->stream_used &&
            $participant->device_token !== $deviceToken
        ) {
            return back()->withErrors([
                'access_code' => 'Este código ya fue utilizado en otro dispositivo'
            ]);
        }

// Primera vez que entra
if (!$participant->stream_used) {

    $participant->stream_used = true;
    $participant->device_token = $deviceToken;
    $participant->save();
}

        // primera vez que entra
        if (!$participant->stream_used)
            {$participant->stream_used = true; 
            $participant->save();
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