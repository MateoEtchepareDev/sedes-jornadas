<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Participants;

class StreamingController extends Controller
{
    public function validateCode(Request $request)
    {
        $participant = Participants::where(
            'access_code',
            $request->access_code        //verifica si esta el codigo
        )->first();

        if (!$participant) {
            return back()->with('error', 'Código inválido');
        }

       session([
            'stream_access' => true,
            'participant_id' => $participant->id   //si el codigo y el participante estan bien le da acceso
        ]);

        if(!session('access_code')){
            return redirect ('/code');
        }
        return redirect('/transmission');  // te redige a la transmision 
    }
}

