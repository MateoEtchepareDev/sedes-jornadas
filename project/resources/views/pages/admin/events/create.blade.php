@extends('layouts.app', ['edit' => true])

@section('edit')
<div class="form-wrapper">
    <div class="form-box">
        <h1 class="form-heading">Nuevo Evento</h1>
        @if ($errors->any())
            <div style="color:red">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('admin.events.store') }}">
            @csrf
            <div class="form-grid">
                <div class="field-group"><label class="field-label">Título</label><input class="field-input" type="text" name="title" required></div>
                <div class="field-group"><label class="field-label">Descripción</label><textarea class="field-input" name="description" rows="3" required></textarea></div>
                <div class="field-group"><label class="field-label">Precio</label><input class="field-input" type="number" step="0.01" name="price" value="0" required></div>
                <div class="field-group"><label class="field-label">URL de transmisión</label><input class="field-input" type="url" name="stream_url"></div>
                <div class="field-group"><label class="field-label">Inicio de inscripción</label><input class="field-input" type="datetime-local" name="registration_opens_at"></div>
                <div class="field-group"><label class="field-label">Fin de inscripción</label><input class="field-input" type="datetime-local" name="registration_closes_at"></div>
                <div class="field-group"><label class="field-label">Inicio del evento</label><input class="field-input" type="datetime-local" name="event_starts_at" required></div>
                <div class="field-group"><label class="field-label">Fin del evento</label><input class="field-input" type="datetime-local" name="event_ends_at" required></div>
                <div class="field-group"><label class="field-label">Máximo de participantes</label><input class="field-input" type="number" name="max_participants"></div>
                <div class="field-group"><label class="field-label">Estado</label>
                    <select class="field-select" name="status" required>
                        <option value="draft">Borrador</option>
                        <option value="published">Publicado</option>
                        <option value="active">Activo</option>
                        <option value="finished">Finalizado</option>
                        <option value="cancelled">Cancelado</option>
                    </select>
                </div>
            </div>
            <div class="submit-zone d-flex flex-wrap gap-2 mt-3">
                <button type="submit" class="btn btn-primary">Crear Evento</button>
                <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">Volver al listado</a>
            </div>
        </form>
    </div>
</div>
@endsection
