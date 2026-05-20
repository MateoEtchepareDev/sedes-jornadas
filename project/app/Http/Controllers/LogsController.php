<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Logs;

class LogsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('logs.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('logs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'participant_id' => 'required|exists:participants,id',
            'action' => 'required|string|max:255',
            'timestamp' => 'required|date',
        ]);

        Logs::create($request->only([
            'event_id',
            'participant_id',
            'action',
            'timestamp',
        ]));

        return redirect()->route('logs.index')
                        ->with('success', 'Log creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('logs.show', compact('log'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('logs.show', compact('log'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'participant_id' => 'required|exists:participants,id',
            'action' => 'required|string|max:255',
            'timestamp' => 'required|date',
        ]);

        $log->update($request->only([
            'event_id',
            'participant_id',
            'action',
            'timestamp',
        ]));

        return redirect()->route('logs.index')
                        ->with('success', 'Log actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $log->delete();

        return redirect()->route('logs.index')
                        ->with('success', 'Log eliminado correctamente.');
    }
}
