@extends('layouts.app', [
    'inscripcion' => true
])

@section('form')

<section class="form-wrapper">

        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
            <h1 class="form-heading mb-0">Eventos</h1>
            <a href="{{ route('events.create') }}" class="btn btn-primary">Crear evento</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($events->isNotEmpty())
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Título</th>
                            <th>Descripción</th>
                            <th>Precio</th>
                            <th>Transmisión</th>
                            <th>Inicio inscripción</th>
                            <th>Fin inscripción</th>
                            <th>Inicio evento</th>
                            <th>Fin evento</th>
                            <th>Máx. participantes</th>
                            <th>Estado</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($events as $item)
                            <tr>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->description }}</td>
                                <td>${{ number_format($item->price, 2, ',', '.') }}</td>
                                <td>{{ $item->stream_url ?: '—' }}</td>
                                <td>{{ $item->registration_opens_at ?: '—' }}</td>
                                <td>{{ $item->registration_closes_at ?: '—' }}</td>
                                <td>{{ $item->event_starts_at ?: '—' }}</td>
                                <td>{{ $item->event_ends_at ?: '—' }}</td>
                                <td>{{ $item->max_participants ?? '—' }}</td>
                                <td>{{ ucfirst($item->status) }}</td>
                                <td class="text-end">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('events.edit', $item) }}" class="btn btn-sm btn-outline-primary">Editar</a>
                                        <form action="{{ route('events.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar este evento?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        @else
            <div class="alert alert-info mb-0">No hay eventos registrados aún.</div>
        @endif

    </div>
</section>

@endsection