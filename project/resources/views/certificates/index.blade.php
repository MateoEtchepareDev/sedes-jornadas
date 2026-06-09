@extends('layouts.app', ['inscripcion' => true])

@section('form')
<section class="form-wrapper">
    <div class="form-box">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
            <h1 class="form-heading mb-0">Certificados</h1>
            <a href="{{ route('certificates.create') }}" class="btn btn-primary">Crear certificado</a>
        </div>

        @php $items = $certificate ?? collect(); @endphp
        @if($items->isNotEmpty())
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Participante</th>
                            <th>Evento</th>
                            <th>URL del Certificado</th>
                            <th>Fecha</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td>{{ $item->participant_id ?? '-' }}</td>
                                <td>{{ $item->event_id ?? '-' }}</td>
                                <td>{{ $item->certificate_url ?? '-' }}</td>
                                <td>{{ $item->issued_at ?? '-' }}</td>
                                <td class="text-end">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('certificates.edit', $item) }}" class="btn btn-sm btn-outline-primary">Editar</a>
                                        <form action="{{ route('certificates.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar este certificado?');">
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
            </div>
        @else
            <div class="alert alert-info mb-0">No hay certificados registrados aún.</div>
        @endif
    </div>
</section>
@endsection
