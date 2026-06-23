<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;

class LogsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $log = Log::all();

        return view('pages.admin.logs.index', compact('log'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.logs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'event_id' => 'nullable|exists:events,id',
            'action_type' => 'required|string|max:100',
            'actor_type' => 'required|in:admin,system',
            'affected_table' => 'required|string|max:100',
            'entity_id' => 'required|integer|min:1',
        ]);

        Log::create($validated);

        return redirect()->route('admin.logs.index')
            ->with('success', 'Log creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $log = Log::findOrFail($id);

        return view('pages.admin.logs.show', compact('log'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $log = Log::findOrFail($id);

        return view('pages.admin.logs.edit', compact('log'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $log = Log::findOrFail($id);

        $validated = $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'event_id' => 'nullable|exists:events,id',
            'action_type' => 'required|string|max:100',
            'actor_type' => 'required|in:admin,system',
            'affected_table' => 'required|string|max:100',
            'entity_id' => 'required|integer|min:1',
        ]);

        $log->update($validated);

        return redirect()->route('admin.logs.index')
            ->with('success', 'Log actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $log = Log::findOrFail($id);

        $log->delete();

        return redirect()->route('admin.logs.index')
            ->with('success', 'Log eliminado correctamente.');
    }
}