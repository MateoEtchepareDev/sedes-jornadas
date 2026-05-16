<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CertificatesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('certificates.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('certificates.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'participant_id' => 'required|exists:participants,id',
            'event_id' => 'required|exists:events,id',
            'certificate_uuid' => 'required|string|max:255|unique:certificates',
            'issued_at' => 'required|date',
        ]);

        Certificates::create($request->only([
            'participant_id',
            'event_id',
            'certificate_uuid',
            'issued_at',
        ]));

        return redirect()->route('certificates.index')
                        ->with('success', 'Certificado creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('certificates.show', compact('certificate'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('certificates.show', compact('certificate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'participant_id' => 'required|exists:participants,id',
            'event_id' => 'required|exists:events,id',
            'certificate_uuid' => 'required|string|max:255|unique:certificates,certificate_uuid,' . $id,
            'issued_at' => 'required|date',
        ]);

        $certificate->update($request->only([
            'participant_id',
            'event_id',
            'certificate_uuid',
            'issued_at',
        ]));

        return redirect()->route('certificates.index')
                        ->with('success', 'Certificado actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $certificate->delete();

        return redirect()->route('certificates.index')
                        ->with('success', 'Certificado eliminado correctamente.');
    }
}
