<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::orderBy('event_starts_at', 'desc')->get();

        return view('pages.admin.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stream_url' => 'nullable|url|max:500',
            'registration_opens_at' => 'nullable|date',
            'registration_closes_at' => 'nullable|date|after:registration_opens_at',
            'event_starts_at' => 'required|date',
            'event_ends_at' => 'required|date|after:event_starts_at',
            'max_participants' => 'nullable|integer|min:1',
            'status' => 'required|in:draft,published,active,finished,cancelled',
        ]);

        $events = Event::create($request->only([
            'title',
            'description',
            'price',
            'stream_url',
            'registration_opens_at',
            'registration_closes_at',
            'event_starts_at',
            'event_ends_at',
            'max_participants',
            'status',
        ]));

        return redirect()
            ->route('admin.events.index', $events)
            ->with('success', 'Evento creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $events = Event::findOrFail($id);

        $events->loadCount('participants');

        return view('pages.admin.events.index', compact('events'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $event = Event::findOrFail($id);

        $events = Event::orderBy('event_starts_at', 'desc')->get();

        return view('pages.admin.events.edit', compact('event', 'events'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stream_url' => 'nullable|url|max:500',
            'registration_opens_at' => 'nullable|date',
            'registration_closes_at' => 'nullable|date|after:registration_opens_at',
            'event_starts_at' => 'required|date',
            'event_ends_at' => 'required|date|after:event_starts_at',
            'max_participants' => 'nullable|integer|min:1',
            'status' => 'required|in:draft,published,active,finished,cancelled',
        ]);

        $events = Event::findOrFail($id);

        $events->update([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'stream_url' => $request->stream_url,
            'registration_opens_at' => $request->registration_opens_at,
            'registration_closes_at' => $request->registration_closes_at,
            'event_starts_at' => $request->event_starts_at,
            'event_ends_at' => $request->event_ends_at,
            'max_participants' => $request->max_participants,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.events.index', $events)
            ->with('success', 'Evento actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $events = Event::findOrFail($id);

        if ($events->participants()->exists()) {
            return back()->with(
                'error',
                'No se puede eliminar un evento con participantes inscriptos.'
            );
        }

        if ($events->status !== 'draft') {
            return back()->with(
                'error',
                'Solo se pueden eliminar eventos en estado borrador.'
            );
        }

        $events->delete();

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Evento eliminado correctamente.');
    }
}