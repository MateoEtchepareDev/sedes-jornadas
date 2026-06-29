@extends('layouts.app', ['inscripcion' => true])

@section('form')

<section class="form-wrapper py-4">

    <div class="container-fluid">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                    <div>
                        <h2 class="fw-bold text-primary mb-1">
                            Participantes Registrados
                        </h2>

                        <p class="text-muted mb-0">
                            Administración de participantes inscriptos.
                        </p>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-primary rounded-pill">
                            <i class="bi bi-house-door me-1"></i>
                            Página Principal
                        </a>

                        <a href="{{ route('admin.participants.create') }}" class="btn btn-success rounded-pill">
                            <i class="bi bi-person-plus me-1"></i>
                            Crear Participante
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if($participant->isNotEmpty())

                    <div class="table-responsive">
                        <table class="table table-hover align-middle modern-table">
                            <thead class="table-light">
                                <tr>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>DNI</th>
                                    <th>Rol</th>
                                    <th>Modalidad</th>
                                    <th>Método de Pago</th>
                                    <th class="text-end">Acciones</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($participant as $item)
                                    <tr>
                                        <td class="fw-semibold">
                                            {{ $item->full_name }}
                                        </td>

                                        <td>
                                            <span class="d-inline-block text-truncate" style="max-width:220px;" title="{{ $item->email }}">
                                                {{ $item->email }}
                                            </span>
                                        </td>

                                        <td>{{ $item->dni }}</td>

                                        <td>
                                            @if($item->role == 'admin')

                                                <span class="badge bg-danger rounded-pill px-3">
                                                    Administrador
                                                </span>
                                            @elseif($item->role == 'speaker')
                                                <span class="badge bg-primary rounded-pill px-3">
                                                    Disertante
                                                </span>
                                            @else
                                                <span class="badge bg-secondary rounded-pill px-3">
                                                    {{ ucfirst($item->role) }}
                                                </span>
                                            @endif
                                        </td>

                                        <td>
                                            @if($item->modality == 'virtual')
                                                <span class="badge bg-info text-dark rounded-pill px-3">
                                                    <i class="bi bi-laptop me-1"></i>
                                                    Virtual
                                                </span>
                                            @else
                                                <span class="badge bg-success rounded-pill px-3">
                                                    <i class="bi bi-people me-1"></i>
                                                    Presencial
                                                </span>
                                            @endif
                                        </td>

                                        <td>
                                            @if($item->payment_method == 'mercado_pago')
                                                <span class="badge bg-primary rounded-pill px-3">
                                                    Mercado Pago
                                                </span>
                                            @else
                                                <span class="badge bg-secondary rounded-pill px-3">
                                                    Efectivo
                                                </span>
                                            @endif
                                        </td>

                                        <td class="text-end">

                                            <div class="d-flex justify-content-end gap-2">
                                                <a href="{{ route('admin.participants.edit', $item) }}" class="btn btn-outline-primary btn-sm rounded-pill">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                
                                                <form action="{{ route('admin.participants.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar este participante?');">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill">
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
                        No hay participantes registrados aún.
                    </div>

                @endif
            </div>
        </div>
    </div>
</section>

@endsection