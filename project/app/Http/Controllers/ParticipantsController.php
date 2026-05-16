<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ParticipantsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $participants = Participants::all();
        return view('participants.index', compact('participants'));
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
            'event_id' => 'required|exists:events,id',
            'full_name' => 'required|string|max:255',
            'dni' => 'required|string|max:20|unique:participants',
            'email' => 'required|string|email|max:255|unique:participants',
            'modality' => 'required|in: in_person, virtual',
            'payment_status' => 'required|in: pending, approved, rejected,
                refunded, charged_back, cancelled',
            'payment_external_id' => 'nullable|string|max:255',
            'qr_token' => 'nullable|string|max:255',
            'checkin_confirmed' => 'nullable|boolean',
            'access_code' => 'nullable|date',
            'questions_completed' => 'nullable|boolean',
            'paid_at' => 'nullable|date',
        ]);

        Participants::create($request->only([
            'event_id',
            'full_name',
            'dni',
            'email',
            'modality',
            'payment_status',
            'payment_external_id',
            'qr_token',
            'checkin_confirmed',
            'access_code',
            'questions_completed',
            'paid_at',
        ]));

        return redirect()->route('participants.index')
                        ->with('success', 'Participante registrado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('participants.show', compact('participant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('participants.show', compact('participant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'full_name' => 'required|string|max:255',
            'dni' => 'required|string|max:20|unique:participants,dni,' . $id,
            'email' => 'required|string|email|max:255|unique:participants,email,' . $id,
            'modality' => 'required|in: in_person, virtual',
            'payment_status' => 'required|in: pending, approved, rejected,
                refunded, charged_back, cancelled',
            'payment_external_id' => 'nullable|string|max:255',
            'qr_token' => 'nullable|string|max:255',
            'checkin_confirmed' => 'nullable|boolean',
            'access_code' => 'nullable|date',
            'questions_completed' => 'nullable|boolean',
            'paid_at' => 'nullable|date',
        ]);

        $participant->update([
            'event_id'=>$request->event_id,
            'full_name'=>$request->full_name,
            'dni'=>$request->dni,
            'email'=>$request->email,
            'modality'=>$request->modality,
            'payment_status'=>$request->payment_status,
            'payment_external_id'=>$request->payment_external_id,
            'qr_token'=>$request->qr_token,
            'checkin_confirmed'=>$request->checkin_confirmed,
            'access_code'=>$request->access_code,
            'questions_completed'=>$request->questions_completed,
            'paid_at'=>$request->paid_at,
        ]);

        return redirect()->route('participants.index')
                        ->with('success', 'Participante actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $participant->delete();

        return redirect()->route('participants.index')
                        ->with('success', 'Participante eliminado correctamente.');
    }
}
