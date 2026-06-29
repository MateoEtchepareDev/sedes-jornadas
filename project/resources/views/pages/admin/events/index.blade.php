@extends('layouts.app', [
    'inscripcion' => true
])

@section('form')

<section class="form-wrapper py-4">

    <div class="container-fluid">

        <div class="card border-0 shadow-sm">

            <div class="card-header bg-white border-bottom">

                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">

                    <div>
                        <h2 class="fw-bold text-primary mb-1">
                            Gestión de Eventos
                        </h2>
                        <p class="text-muted mb-0">
                            Administración de los eventos registrados.
                        </p>
                    </div>

                    <div class="d-flex flex-wrap gap-2">

                        <a href="{{ route('admin.dashboard') }}"
                           class="btn btn-outline-primary rounded-pill">

                            <i class="bi bi-house-door me-1"></i>
                            Página Principal

                        </a>

                        <a href="{{ route('admin.events.create') }}"
                           class="btn btn-success rounded-pill">

                            <i class="bi bi-plus-circle me-1"></i>
                            Crear Evento

                        </a>

                    </div>

                </div>

            </div>

            <div class="card-body">

                @if(session('success'))

                    <div class="alert alert-success alert-dismissible fade show">

                        <i class="bi bi-check-circle-fill me-2"></i>

                        {{ session('success') }}

                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="alert">
                        </button>

                    </div>

                @endif

                @if($events->isNotEmpty())

                    <div class="table-responsive">

                        <table class="table table-hover align-middle modern-table">

                            <thead class="table-light">

                                <tr>

                                    <th>Título</th>
                                    <th>Descripción</th>
                                    <th>Precio</th>
                                    <th>Transmisión</th>
                                    <th>Inicio inscripción</th>
                                    <th>Fin inscripción</th>
                                    <th>Inicio evento</th>
                                    <th>Fin evento</th>
                                    <th>Máx.</th>
                                    <th>Estado</th>
                                    <th class="text-end">Acciones</th>

                                </tr>

                            </thead>

                            <tbody>

                                @foreach($events as $item)

                                    <tr>

                                        <td class="fw-semibold">
                                            {{ $item->title }}
                                        </td>

                                        <td style="max-width:220px;">

                                            <span
                                                class="d-inline-block text-truncate"
                                                style="max-width:220px;"
                                                title="{{ $item->description }}">

                                                {{ $item->description }}

                                            </span>

                                        </td>

                                        <td class="fw-semibold text-success">

                                            ${{ number_format($item->price,2,',','.') }}

                                        </td>

                                        <td style="max-width:170px;">

                                            @if($item->stream_url)

                                                <span
                                                    class="badge bg-light text-dark text-truncate"
                                                    style="max-width:160px;"
                                                    title="{{ $item->stream_url }}">

                                                    <i class="bi bi-camera-video me-1"></i>

                                                    {{ $item->stream_url }}

                                                </span>

                                            @else

                                                <span class="text-muted">—</span>

                                            @endif

                                        </td>

                                        <td>{{ $item->registration_opens_at ?: '—' }}</td>

                                        <td>{{ $item->registration_closes_at ?: '—' }}</td>

                                        <td>{{ $item->event_starts_at ?: '—' }}</td>

                                        <td>{{ $item->event_ends_at ?: '—' }}</td>

                                        <td>

                                            {{ $item->max_participants ?? '—' }}

                                        </td>

                                        <td>

                                            @php
                                                $badge = match($item->status){
                                                    'draft' => 'secondary',
                                                    'published' => 'primary',
                                                    'active' => 'success',
                                                    'finished' => 'dark',
                                                    'cancelled' => 'danger',
                                                    default => 'secondary'
                                                };
                                            @endphp

                                            <span class="badge bg-{{ $badge }} rounded-pill px-3 py-2">

                                                {{ ucfirst($item->status) }}

                                            </span>

                                        </td>

                                        <td class="text-end">

                                            <div class="d-flex justify-content-end gap-2">

                                                <a href="{{ route('admin.events.edit', $item) }}"
                                                   class="btn btn-outline-primary btn-sm rounded-pill">

                                                    <i class="bi bi-pencil-square"></i>

                                                </a>

                                                <form
                                                    action="{{ route('admin.events.destroy', $item) }}"
                                                    method="POST"
                                                    class="d-inline"
                                                    onsubmit="return confirm('¿Eliminar este evento?');">

                                                    @csrf
                                                    @method('DELETE')

                                                    <button
                                                        type="submit"
                                                        class="btn btn-outline-danger btn-sm rounded-pill">

                                                        <i class="bi bi-trash"></i>

                                                    </button>

                                                </form>

                                            </div>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                @else

                    <div class="alert alert-info text-center mb-0">

                        <i class="bi bi-info-circle me-2"></i>

                        No hay eventos registrados aún.

                    </div>

                @endif

            </div>

        </div>

    </div>

</section>

@endsection