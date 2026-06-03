<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\FormularioMail;

class FormController extends Controller
{
    public function enviar(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email'
        ]);

        $full_name = $request->full_name;
        $email = $request->email;

        Mail::to($email)->send(
            new FormularioMail($full_name)
        );

        return back()->with('success', 'Correo enviado');
    }
}