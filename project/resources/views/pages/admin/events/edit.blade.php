@extends('layouts.app', ['edit' => true])

@section('edit')

<div class="container py-4">

    <div class="card shadow-sm border-0">

        <div class="card-header bg-white border-bottom">

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

                <div>
                    <h2 class="fw-bold text-primary mb-1">
                        Editar Evento
                    </h2>

                    <p class="text-muted mb-0">
                        Modifica la información del evento.
                    </p>
                </div>

                <a href="{{ route('admin.events.index') }}"
                   class="btn btn-outline-secondary rounded-pill">

                    <i class="bi bi-arrow-left me-1"></i>

                    Volver

                </a>

            </div>

        </div>

        <div class="card-body">

            <form method="POST" action="{{ route('admin.events.update', $event->id ?? 1) }}">

                @csrf
                @method('PUT')

                <div class="row g-4">

                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Título
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            name="title"
                            value="{{ $event->title ?? '' }}"
                            required>

                    </div>

                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Precio
                        </label>

                        <input
                            type="number"
                            step="0.01"
                            class="form-control"
                            name="price"
                            value="{{ $event->price ?? 0 }}"
                            required>

                    </div>

                    <div class="col-12">

                        <label class="form-label fw-semibold">
                            Descripción
                        </label>

                        <textarea
                            class="form-control"
                            rows="4"
                            name="description"
                            required>{{ $event->description ?? '' }}</textarea>

                    </div>

                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            URL de transmisión
                        </label>

                        <input
                            type="url"
                            class="form-control"
                            name="stream_url"
                            value="{{ $event->stream_url ?? '' }}">

                    </div>

                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Máximo de participantes
                        </label>

                        <input
                            type="number"
                            class="form-control"
                            name="max_participants"
                            value="{{ $event->max_participants ?? '' }}">

                    </div>

                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Inicio de inscripción
                        </label>

                        <input
                            type="datetime-local"
                            class="form-control"
                            name="registration_opens_at"
                            value="{{ $event->registration_opens_at ?? '' }}">

                    </div>

                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Fin de inscripción
                        </label>

                        <input
                            type="datetime-local"
                            class="form-control"
                            name="registration_closes_at"
                            value="{{ $event->registration_closes_at ?? '' }}">

                    </div>

                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Inicio del evento
                        </label>

                        <input
                            type="datetime-local"
                            class="form-control"
                            name="event_starts_at"
                            value="{{ $event->event_starts_at ?? '' }}"
                            required>

                    </div>

                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Fin del evento
                        </label>

                        <input
                            type="datetime-local"
                            class="form-control"
                            name="event_ends_at"
                            value="{{ $event->event_ends_at ?? '' }}"
                            required>

                    </div>

                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Estado
                        </label>

                        <select
                            class="form-select"
                            name="status"
                            required>

                            <option value="draft" {{ ($event->status ?? '') == 'draft' ? 'selected' : '' }}>
                                Borrador
                            </option>

                            <option value="published" {{ ($event->status ?? '') == 'published' ? 'selected' : '' }}>
                                Publicado
                            </option>

                            <option value="active" {{ ($event->status ?? '') == 'active' ? 'selected' : '' }}>
                                Activo
                            </option>

                            <option value="finished" {{ ($event->status ?? '') == 'finished' ? 'selected' : '' }}>
                                Finalizado
                            </option>

                            <option value="cancelled" {{ ($event->status ?? '') == 'cancelled' ? 'selected' : '' }}>
                                Cancelado
                            </option>

                        </select>

                    </div>

                </div>

                <hr class="my-4">

                <div class="d-flex flex-wrap justify-content-end gap-2">

                    <a href="{{ route('admin.events.index') }}"
                       class="btn btn-outline-secondary rounded-pill">

                        <i class="bi bi-arrow-left me-1"></i>

                        Volver

                    </a>

                    <button
                        type="submit"
                        class="btn btn-primary rounded-pill">

                        <i class="bi bi-check-circle me-1"></i>

                        Actualizar Evento

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection