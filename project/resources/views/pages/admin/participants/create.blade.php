@extends('layouts.app', ['edit' => true])

@section('edit')

<section class="form-wrapper py-4">

    <div class="container-fluid">
        <div class="card border-0 shadow-sm">

            <div class="card-header bg-white border-bottom">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">

                    <div>
                        <h2 class="fw-bold text-primary mb-1">
                            Nuevo Participante
                        </h2>

                        <p class="text-muted mb-0">
                            Complete los datos para registrar un nuevo participante.
                        </p>
                    </div>

                    <a href="{{ route('admin.participants.index') }}" class="btn btn-outline-primary rounded-pill">
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

                <form method="POST" action="{{ route('participants.storeCrud') }}">
                    @csrf

                    <input type="hidden" name="event_id" value="{{ $event->id ?? 1 }}">

                    <div class="row g-4">

                        <div class="col-md-6">
                            <label class="form-label fw-semibold"> Nombre </label>
                            <input type="text" class="form-control" name="full_name" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold"> DNI </label>
                            <input type="number" class="form-control" name="dni" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold"> Email </label>
                            <input type="email" class="form-control" name="email" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold"> Rol </label>
                            <select class="form-select" name="role" required>
                                <option value="profesor">Profesor</option>
                                <option value="alumno">Alumno</option>
                                <option value="oyente">Oyente</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold"> Modalidad </label>
                            <select class="form-select" name="modality" required>
                                <option value="in_person">Presencial</option>
                                <option value="virtual">Virtual</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold"> Estado de Pago </label>
                            <select class="form-select" name="payment_status" required>
                                <option value="pending">Pendiente</option>
                                <option value="approved">Aprobado</option>
                                <option value="rejected">Rechazado</option>
                                <option value="refunded">Reembolsado</option>
                                <option value="charged_back">Cobrado de nuevo</option>
                                <option value="cancelled">Cancelado</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold"> Método de Pago </label>
                            <select class="form-select" name="payment_method" required>
                                <option value="cash">Efectivo</option>
                                <option value="mercado_pago">Mercado Pago</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold"> ID Externo </label>
                            <input type="text" class="form-control" name="payment_external_id">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold"> QR Token </label>
                            <input type="text" class="form-control" name="qr_token">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold"> Check-in </label>
                            <select class="form-select" name="checkin_confirmed" required>
                                <option value="1">Sí</option>
                                <option value="0">No</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold"> Código de Acceso </label>
                            <input type="text" class="form-control" name="access_code">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold"> Preguntas Completadas </label>
                            <select class="form-select" name="questions_completed" required>
                                <option value="1">Sí</option>
                                <option value="0">No</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold"> Registrado </label>
                            <input type="datetime-local" class="form-control" name="registered_at">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold"> Pagado </label>
                            <input type="datetime-local" class="form-control" name="paid_at">
                        </div>

                    </div>

                    <div class="d-flex flex-wrap justify-content-end gap-2 mt-4 pt-3 border-top">

                        <a href="{{ route('admin.participants.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                            <i class="bi bi-arrow-left me-1"></i>
                            Volver
                        </a>

                        <button type="submit" class="btn btn-success rounded-pill px-4">
                            <i class="bi bi-person-plus-fill me-1"></i>
                            Crear Participante
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>

</section>

@endsection