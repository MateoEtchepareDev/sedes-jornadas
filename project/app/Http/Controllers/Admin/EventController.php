<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventRequest;
use App\Models\Event;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class EventController extends Controller
{
    public function index(): View
    {
        $events = Event::orderBy('event_starts_at', 'desc')->get();

        return view('pages.admin.events', compact('events'));
    }

    public function show(Event $event): View
    {
        $event->loadCount('participants');

        return view('pages.admin.events.show', compact('event'));
    }

    public function create(): View
    {
        return view('pages.admin.events.create');
    }

    public function store(StoreEventRequest $request): RedirectResponse
    {
        $event = Event::create($request->validated());

        return redirect()
            ->route('admin.events.show', $event)
            ->with('success', 'Jornada creada correctamente.');
    }

    public function edit(Event $event): View
    {
        return view('pages.admin.events.edit', compact('event'));
    }

    public function update(StoreEventRequest $request, Event $event): RedirectResponse
    {
        $event->update($request->validated());

        return redirect()
            ->route('admin.events.show', $event)
            ->with('success', 'Jornada actualizada correctamente.');
    }

    public function destroy(Event $event): RedirectResponse
    {
        // Solo se puede eliminar si está en draft y no tiene participantes
        if ($event->participants()->exists()) {
            return back()->with('error', 'No se puede eliminar una jornada con participantes inscriptos.');
        }

        if ($event->status !== 'draft') {
            return back()->with('error', 'Solo se pueden eliminar jornadas en estado borrador.');
        }

        $event->delete();

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Jornada eliminada correctamente.');
    }
}
