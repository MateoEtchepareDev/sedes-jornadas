<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;

use App\Mail\FormularioMail;

use App\Models\Participants;

class ParticipantsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $participant = Participants::all();
        return view('participants.index', compact('participant'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('participants.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'event_id' => 'required',
            'full_name' => 'required|string|max:255',
            'dni' => 'required|string|max:20|unique:participants',
            'email' => 'required|string|email|max:255|unique:participants',
            'role' => 'required|in:profesor,alumno,oyente',
            'modality' => 'required|in:in_person,virtual',
            'payment_status' => 'required|in:pending,approved,rejected,refunded,charged_back,cancelled',
            'payment_method' => 'required|in:mercado_pago,cash',
            'payment_external_id' => 'nullable|string|max:255',
            'qr_token' => 'nullable|string|max:255',
            'checkin_confirmed' => 'nullable|boolean',
            'access_code' => 'nullable|string|max:30',
            'questions_completed' => 'nullable|boolean',
            'registered_at' => 'nullable|date',
            'paid_at' => 'nullable|date',
        ]);

        $participant = Participants::create($request->only([
            'event_id',
            'full_name',
            'dni',
            'email',
            'role',
            'modality',
            'payment_status',
            'payment_method',
            'payment_external_id',
            'qr_token',
            'checkin_confirmed',
            'access_code',
            'questions_completed',
            'registered_at',
            'paid_at',
        ]));

        if ($participant->payment_method == 'cash') {
             try {

                Mail::to($participant->email)->send(
                    new FormularioMail(
                        $participant->full_name
                    )
                );

            } catch (\Exception $e) {

                \Log::error($e->getMessage());

            }

        }
        
         return redirect()->route('participants.index')
                            ->with('success', 'Participante creado correctamente y correo enviado.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Participants $participant)
    {
        return view('participants.show', compact('participant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Participants $participant)
    {
        return view('participants.edit', compact('participant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Participants $participant)
    {
        $request->validate([
            'event_id' => 'required',
            'full_name' => 'required|string|max:255',
            'dni' => 'required|string|max:20|unique:participants,dni,' . $participant->id,
            'email' => 'required|string|email|max:255|unique:participants,email,' . $participant->id,
            'role' => 'required|in:profesor,alumno,oyente',
            'modality' => 'required|in:in_person,virtual',
            'payment_status' => 'required|in:pending,approved,rejected,refunded,charged_back,cancelled',
            'payment_method' => 'required|in:mercado_pago,cash',
            'payment_external_id' => 'nullable|string|max:255',
            'qr_token' => 'nullable|string|max:255',
            'checkin_confirmed' => 'nullable|boolean',
            'access_code' => 'nullable|string|max:30',
            'questions_completed' => 'nullable|boolean',
            'registered_at' => 'nullable|date',
            'paid_at' => 'nullable|date',
        ]);

        $participant->update([
            'event_id'=>$request->event_id,
            'full_name'=>$request->full_name,
            'dni'=>$request->dni,
            'email'=>$request->email,
            'role'=>$request->role,
            'modality'=>$request->modality,
            'payment_status'=>$request->payment_status,
            'payment_method'=>$request->payment_method,
            'payment_external_id'=>$request->payment_external_id,
            'qr_token'=>$request->qr_token,
            'checkin_confirmed'=>$request->checkin_confirmed,
            'access_code'=>$request->access_code,
            'questions_completed'=>$request->questions_completed,
            'registered_at'=>$request->registered_at,
            'paid_at'=>$request->paid_at,
        ]);

        return redirect()->route('participants.index')
                        ->with('success', 'Participante actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Participants $participant)
    {
        $participant->delete();

        return redirect()->route('participants.index')
                        ->with('success', 'Participante eliminado correctamente.');
    }
}
