@extends('layouts.app', ['edit' => true])

@section('edit')
<div class="form-wrapper">
    <div class="form-box">
        <h1 class="form-heading">Editar Log</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('logs.update', $log->id) }}">
            @csrf
            @method('PUT')

            <div class="form-grid">

                <div class="field-group">
                    <label class="field-label">ID Usuario</label>
                    <input
                        class="field-input"
                        type="number"
                        name="user_id"
                        value="{{ old('user_id', $log->user_id) }}"
                    >
                </div>

                <div class="field-group">
                    <label class="field-label">ID Evento</label>
                    <input
                        class="field-input"
                        type="number"
                        name="event_id"
                        value="{{ old('event_id', $log->event_id) }}"
                    >
                </div>

                <div class="field-group">
                    <label class="field-label">Tipo de Acción</label>
                    <input
                        class="field-input"
                        type="text"
                        name="action_type"
                        value="{{ old('action_type', $log->action_type) }}"
                        required
                    >
                </div>

                <div class="field-group">
                    <label class="field-label">Actor</label>
                    <select class="field-input" name="actor_type" required>
                        <option value="admin"
                            {{ $log->actor_type == 'admin' ? 'selected' : '' }}>
                            Admin
                        </option>

                        <option value="system"
                            {{ $log->actor_type == 'system' ? 'selected' : '' }}>
                            System
                        </option>
                    </select>
                </div>

                <div class="field-group">
                    <label class="field-label">Tabla afectada</label>
                    <input
                        class="field-input"
                        type="text"
                        name="affected_table"
                        value="{{ old('affected_table', $log->affected_table) }}"
                        required
                    >
                </div>

                <div class="field-group">
                    <label class="field-label">ID Entidad</label>
                    <input
                        class="field-input"
                        type="number"
                        name="entity_id"
                        value="{{ old('entity_id', $log->entity_id) }}"
                        required
                    >
                </div>

            </div>

            <div class="submit-zone d-flex flex-wrap gap-2 mt-3">
                <button type="submit" class="btn btn-primary">
                    Actualizar Log
                </button>

                <a href="{{ route('logs.index') }}" class="btn btn-secondary">
                    Volver al listado
                </a>
            </div>
        </form>
    </div>
</div>
@endsection