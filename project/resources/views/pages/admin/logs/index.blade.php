@extends('layouts.app', ['inscripcion' => true])

@section('form')

<section class="form-wrapper py-4">

    <div class="container-fluid">
        <div class="card border-0 shadow-sm">

            <div class="card-header bg-white border-bottom">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">

                    <div>
                        <h2 class="fw-bold text-primary mb-1">
                            <i class="bi bi-journal-text me-2"></i>
                            Logs del Sistema
                        </h2>

                        <p class="text-muted mb-0">
                            Administración y seguimiento de los registros del sistema.
                        </p>
                    </div>

                    <div class="d-flex flex-wrap gap-2">

                        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-primary rounded-pill">
                            <i class="bi bi-house-door me-1"></i>
                            Página Principal
                        </a>

                        <a href="{{ route('admin.logs.create') }}" class="btn btn-success rounded-pill">
                            <i class="bi bi-plus-circle me-1"></i>
                            Crear Log
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

                @php
                    $items = $log ?? collect();
                @endphp

                @if($items->isNotEmpty())

                    <div class="table-responsive">

                        <table class="table table-hover align-middle modern-table">

                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Usuario</th>
                                    <th>Evento</th>
                                    <th>Acción</th>
                                    <th>Actor</th>
                                    <th>Tabla</th>
                                    <th>Entidad</th>
                                    <th>Fecha</th>
                                    <th class="text-end">Acciones</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach($items as $item)

                                    <tr>

                                        <td>
                                            <span class="badge bg-secondary rounded-pill">
                                                #{{ $item->id }}
                                            </span>
                                        </td>

                                        <td>{{ $item->user_id ?? '-' }}</td>

                                        <td>{{ $item->event_id ?? '-' }}</td>

                                        <td>
                                            <span class="badge bg-primary rounded-pill px-3">
                                                {{ $item->action_type }}
                                            </span>
                                        </td>

                                        <td>

                                            @if($item->actor_type == 'admin')

                                                <span class="badge bg-danger rounded-pill px-3">
                                                    Admin
                                                </span>

                                            @else

                                                <span class="badge bg-secondary rounded-pill px-3">
                                                    System
                                                </span>

                                            @endif

                                        </td>

                                        <td>
                                            <span class="text-truncate d-inline-block" style="max-width:150px;" title="{{ $item->affected_table }}">
                                                {{ $item->affected_table }}
                                            </span>
                                        </td>

                                        <td>{{ $item->entity_id }}</td>

                                        <td>{{ $item->created_at }}</td>

                                        <td class="text-end">

                                            <div class="d-flex justify-content-end gap-2">

                                                <a href="{{ route('admin.logs.edit', $item->id) }}" class="btn btn-outline-primary btn-sm rounded-pill">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>

                                                <form action="{{ route('admin.logs.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar este log?')">
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
                        No hay logs registrados aún.
                    </div>

                @endif

            </div>

        </div>
    </div>

</section>

@endsection