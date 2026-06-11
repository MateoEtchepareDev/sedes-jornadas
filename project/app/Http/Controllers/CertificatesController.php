<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Certificates;

class CertificatesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $certificate = Certificates::all();
        return view('certificates.index', compact('certificate'));
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
            'certificate_url' => 'required|string|max:255|unique:certificates',
            'issued_at' => 'required|date',
        ]);

        $certificate = Certificates::create($request->only([
            'participant_id',
            'event_id',
            'certificate_url',
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
        $certificate = Certificates::findOrFail($id);
        return view('certificates.show', compact('certificate'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $certificate = Certificates::findOrFail($id);
        return view('certificates.edit', compact('certificate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $certificate = Certificates::findOrFail($id);
        $request->validate([
            'participant_id' => 'required|exists:participants,id',
            'event_id' => 'required|exists:events,id',
            'certificate_url' => 'required|string|max:255|unique:certificates,certificate_url,' . $id,
            'issued_at' => 'required|date',
        ]);
        $certificate->update($request->only([
            'participant_id',
            'event_id',
            'certificate_url',
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
        $certificate = Certificates::findOrFail($id);
        $certificate->delete();

        return redirect()->route('certificates.index')
                        ->with('success', 'Certificado eliminado correctamente.');
    }
}
