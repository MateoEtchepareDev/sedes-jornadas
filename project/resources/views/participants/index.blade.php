@extends('layouts.app', [
    'inscripcion' => true
])

@section('form')

<section class="form-wrapper">
    <div class="form-box">

        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
            <h1 class="form-heading mb-0">Participantes Registrados</h1>
            <a href="{{ route('participants.create') }}" class="btn btn-primary">Crear participante</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($participant->isNotEmpty())
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>DNI</th>
                            <th>Rol</th>
                            <th>Modalidad</th>
                            <th>Método</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($participant as $item)
                            <tr>
                                <td>{{ $item->full_name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->dni }}</td>
                                <td>{{ ucfirst($item->role) }}</td>
                                <td>{{ $item->modality == 'virtual' ? 'Virtual' : 'Presencial' }}</td>
                                <td>{{ $item->payment_method == 'mercado_pago' ? 'Mercado Pago' : 'Efectivo' }}</td>
                                <td class="text-end">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('participants.edit', $item) }}" class="btn btn-sm btn-outline-primary">Editar</a>
                                        <form action="{{ route('participants.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar este participante?');">
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
            <div class="alert alert-info mb-0">No hay participantes registrados aún.</div>
        @endif

    </div>
</section>

@endsection