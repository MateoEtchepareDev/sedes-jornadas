@extends('layouts.app', ['inscripcion' => true])

@section('form')

<section class="form-wrapper py-4">

    <div class="container-fluid">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                    <div>
                        <h2 class="fw-bold text-primary mb-1">
                            Usuarios
                        </h2>
                        <p class="text-muted mb-0">
                            Administración de usuarios registrados.
                        </p>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-primary rounded-pill">
                            <i class="bi bi-house-door me-1"></i>
                            Página Principal
                        </a>

                        <a href="{{ route('admin.users.create') }}" class="btn btn-success rounded-pill">
                            <i class="bi bi-person-plus me-1"></i>
                            Crear Usuario
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
                    $items = $users ?? collect();
                @endphp

                @if($items->isNotEmpty())

                    <div class="table-responsive">

                        <table class="table table-hover align-middle modern-table">

                            <thead class="table-light">

                                <tr>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Rol</th>
                                    <th class="text-end">Acciones</th>
                                </tr>

                            </thead>

                            <tbody>

                                @foreach($items as $item)

                                    <tr>

                                        <td class="fw-semibold">
                                            {{ $item->name ?? '-' }}
                                        </td>

                                        <td>
                                            <span class="d-inline-block text-truncate" style="max-width:260px;" title="{{ $item->email ?? '-' }}">
                                                {{ $item->email ?? '-' }}
                                            </span>
                                        </td>

                                        <td>
                                            @if($item->is_admin ?? false)
                                                <span class="badge bg-danger rounded-pill px-3">
                                                    <i class="bi bi-shield-lock me-1"></i>
                                                    Administrador
                                                </span>
                                            @else
                                                <span class="badge bg-primary rounded-pill px-3">
                                                    <i class="bi bi-person me-1"></i>
                                                    Usuario
                                                </span>
                                            @endif
                                        </td>

                                        <td class="text-end">
                                            <div class="d-flex justify-content-end gap-2">

                                                <a href="{{ route('admin.users.edit', $item) }}" class="btn btn-outline-primary btn-sm rounded-pill">
                                                    <i class="bi bi-pencil-square me-1"></i>
                                                    Editar
                                                </a>

                                                <form action="{{ route('admin.users.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar este usuario?');">

                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill">
                                                        <i class="bi bi-trash me-1"></i>
                                                        Eliminar
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
                        No hay usuarios registrados aún.
                    </div>
                @endif
            </div>
        </div>
    </div>

</section>

@endsection