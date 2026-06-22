<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Participant;

class StreamingController extends Controller
{
    public function validateCode(Request $request)
    {
        $participant = Participant::where(
            'access_code',
            $request->access_code        //verifica si esta el codigo
        )->first();

        if (!$participant) {
            return back()->with('error', 'Código inválido');
        }

        session([
            'stream_access' => true,
            'participant_id' => $participant->id,   //si el codigo y el participante estan bien le da acceso
            'participant_name' => $participant->full_name,
            'participant_email' => $participant->email,
            'participant_dni' => $participant->dni,
        ]);

        /* if(!session('access_code')){
            return redirect ('/code');
        } */
        return redirect('/transmission');  // te redige a la transmision 
    }
}

