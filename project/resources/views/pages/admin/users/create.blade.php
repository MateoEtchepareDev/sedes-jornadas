@extends('layouts.app', ['edit' => true])

@section('edit')

<section class="form-wrapper py-4">

    <div class="container-fluid">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                    <div>
                        <h2 class="fw-bold text-primary mb-1">
                            Nuevo Usuario
                        </h2>

                        <p class="text-muted mb-0">
                            Complete la información para registrar un nuevo usuario.
                        </p>

                    </div>

                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-primary rounded-pill">
                        <i class="bi bi-arrow-left me-1"></i>
                        Volver al listado
                    </a>
                </div>
            </div>

            <div class="card-body">
                @if ($errors->any())

                    <div class="alert alert-danger alert-dismissible fade show">

                        <div class="fw-semibold mb-2">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            Se encontraron errores.
                        </div>

                        <ul class="mb-0 ps-3">

                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach

                        </ul>

                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>

                @endif

                <form method="POST" action="{{ route('admin.users.store') }}">

                    @csrf

                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold"> Nombre </label>
                            <input type="text" class="form-control" name="name" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold"> Email </label>
                            <input type="email" class="form-control" name="email" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold"> Contraseña </label>
                            <input type="password" class="form-control" name="password_hash" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold"> Confirmar Contraseña </label>
                            <input type="password" class="form-control" name="password_hash_confirmation" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold"> Administrador </label>
                            <select class="form-select" name="is_admin" required>
                                <option value="0">No</option>
                                <option value="1">Sí</option>
                            </select>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap justify-content-end gap-2 mt-4 pt-3 border-top">

                        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                            <i class="bi bi-arrow-left me-1"></i>
                            Volver
                        </a>

                        <button type="submit" class="btn btn-success rounded-pill px-4">
                            <i class="bi bi-person-plus-fill me-1"></i>
                            Crear Usuario
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</section>

@endsection