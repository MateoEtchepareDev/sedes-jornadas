@extends('layouts.app', ['edit' => true])

@section('edit')
<div class="form-wrapper">
    <div class="form-box">
        <h1 class="form-heading">Editar Evento</h1>

        <form method="POST" action="{{ route('events.update', $events->id ?? 1) }}">
            @csrf
            @method('PUT')
            <div class="form-grid">
                <div class="field-group"><label class="field-label">Título</label><input class="field-input" type="text" name="title" value="{{ $events->title ?? '' }}" required></div>
                <div class="field-group"><label class="field-label">Descripción</label><textarea class="field-input" name="description" rows="3" required>{{ $events->description ?? '' }}</textarea></div>
                <div class="field-group"><label class="field-label">Precio</label><input class="field-input" type="number" step="0.01" name="price" value="{{ $events->price ?? 0 }}" required></div>
                <div class="field-group"><label class="field-label">URL de transmisión</label><input class="field-input" type="url" name="stream_url" value="{{ $events->stream_url ?? '' }}"></div>
                <div class="field-group"><label class="field-label">Inicio de inscripción</label><input class="field-input" type="datetime-local" name="registration_opens_at" value="{{ $events->registration_opens_at ?? '' }}"></div>
                <div class="field-group"><label class="field-label">Fin de inscripción</label><input class="field-input" type="datetime-local" name="registration_closes_at" value="{{ $events->registration_closes_at ?? '' }}"></div>
                <div class="field-group"><label class="field-label">Inicio del evento</label><input class="field-input" type="datetime-local" name="event_starts_at" value="{{ $events->event_starts_at ?? '' }}" required></div>
                <div class="field-group"><label class="field-label">Fin del evento</label><input class="field-input" type="datetime-local" name="event_ends_at" value="{{ $events->event_ends_at ?? '' }}" required></div>
                <div class="field-group"><label class="field-label">Máximo de participantes</label><input class="field-input" type="number" name="max_participants" value="{{ $events->max_participants ?? '' }}"></div>
                <div class="field-group"><label class="field-label">Estado</label>
                    <select class="field-select" name="status" required>
                        <option value="draft" {{ ($events->status ?? '') == 'draft' ? 'selected' : '' }}>Borrador</option>
                        <option value="published" {{ ($events->status ?? '') == 'published' ? 'selected' : '' }}>Publicado</option>
                        <option value="active" {{ ($events->status ?? '') == 'active' ? 'selected' : '' }}>Activo</option>
                        <option value="finished" {{ ($events->status ?? '') == 'finished' ? 'selected' : '' }}>Finalizado</option>
                        <option value="cancelled" {{ ($events->status ?? '') == 'cancelled' ? 'selected' : '' }}>Cancelado</option>
                    </select>
                </div>
            </div>
            <div class="submit-zone d-flex flex-wrap gap-2 mt-3">
                <button type="submit" class="btn btn-primary">Actualizar Evento</button>
                <a href="{{ route('events.index') }}" class="btn btn-secondary">Volver al listado</a>
            </div>
        </form>
    </div>
</div>
@endsection
