@extends('layouts.app', ['edit' => true])

@section('edit')

<section class="form-wrapper py-4">

    <div class="container-fluid">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div>
                        <h2 class="fw-bold text-primary mb-1"><i class="bi bi-journal-plus me-2"></i> Nuevo Log </h2>
                        <p class="text-muted mb-0"> Registrar una nueva acción del sistema.</p>
                    </div>
                    <a href="{{ route('admin.logs.index') }}" class="btn btn-outline-primary rounded-pill"><i class="bi bi-arrow-left me-1"></i> Volver al listado </a>
                </div>
            </div>

            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show"><i class="bi bi-exclamation-triangle-fill me-2"></i><strong>Se encontraron errores:</strong>
                        
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>

                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.logs.store') }}">
                    @csrf
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold"> ID Usuario </label>
                            <input type="number" name="user_id" class="form-control" value="{{ old('user_id') }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold"> ID Evento </label>
                            <input type="number" name="event_id" class="form-control" value="{{ old('event_id') }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold"> Tipo de Acción </label>
                            <input type="text" name="action_type" class="form-control" value="{{ old('action_type') }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold"> Actor </label>
                            <select name="actor_type" class="form-select" required>
                                <option value="admin">
                                    Admin
                                </option>

                                <option value="system">
                                    System
                                </option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold"> Tabla afectada </label>
                            <input type="text" name="affected_table" class="form-control" value="{{ old('affected_table') }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold"> ID Entidad </label>
                            <input type="number" name="entity_id" class="form-control" value="{{ old('entity_id') }}" required>
                        </div>

                    </div>

                    <div class="d-flex flex-wrap justify-content-end gap-2 mt-4">
                        <a href="{{ route('admin.logs.index') }}" class="btn btn-outline-secondary rounded-pill">
                            <i class="bi bi-arrow-left me-1"></i>
                            Volver
                        </a>

                        <button type="submit" class="btn btn-success rounded-pill">
                            <i class="bi bi-plus-circle me-1"></i>
                            Crear Log
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</section>

@endsection