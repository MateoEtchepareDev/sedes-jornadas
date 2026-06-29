@extends('layouts.app', ['edit' => true])

@section('edit')

<section class="form-wrapper py-4">

    <div class="container-fluid">

        <div class="card border-0 shadow-sm mb-4">

            <div class="card-header bg-white border-bottom">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">

                    <div>
                        <h2 class="fw-bold text-primary mb-1">
                            Editar Participante
                        </h2>

                        <p class="text-muted mb-0">
                            Modifica la información del participante registrado.
                        </p>
                    </div>

                    <a href="{{ route('admin.participants.index') }}" class="btn btn-outline-primary rounded-pill">
                        <i class="bi bi-arrow-left me-1"></i>
                        Volver al listado
                    </a>

                </div>
            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-hover align-middle modern-table mb-0">

                        <thead class="table-light">
                            <tr>
                                <th>Evento</th>
                                <th>Nombre</th>
                                <th>DNI</th>
                                <th>Email</th>
                                <th>Rol</th>
                                <th>Modalidad</th>
                                <th>Estado Pago</th>
                                <th>Método</th>
                            </tr>
                        </thead>

                        <tbody>

                            <tr>

                                <td>
                                    <span class="badge bg-secondary rounded-pill">
                                        {{ $participant->event_id }}
                                    </span>
                                </td>

                                <td class="fw-semibold">
                                    {{ $participant->full_name }}
                                </td>

                                <td>{{ $participant->dni }}</td>

                                <td>
                                    <span class="d-inline-block text-truncate"
                                          style="max-width:220px;"
                                          title="{{ $participant->email }}">
                                        {{ $participant->email }}
                                    </span>
                                </td>

                                <td>

                                    @if($participant->role == 'admin')

                                        <span class="badge bg-danger rounded-pill px-3">
                                            Administrador
                                        </span>

                                    @elseif($participant->role == 'speaker')

                                        <span class="badge bg-primary rounded-pill px-3">
                                            Disertante
                                        </span>

                                    @else

                                        <span class="badge bg-secondary rounded-pill px-3">
                                            {{ ucfirst($participant->role) }}
                                        </span>

                                    @endif

                                </td>

                                <td>

                                    @if($participant->modality == 'virtual')

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

                                    @if($participant->payment_status == 'approved')

                                        <span class="badge bg-success rounded-pill px-3">
                                            Aprobado
                                        </span>

                                    @elseif($participant->payment_status == 'pending')

                                        <span class="badge bg-warning text-dark rounded-pill px-3">
                                            Pendiente
                                        </span>

                                    @elseif($participant->payment_status == 'rejected')

                                        <span class="badge bg-danger rounded-pill px-3">
                                            Rechazado
                                        </span>

                                    @else

                                        <span class="badge bg-secondary rounded-pill px-3">
                                            {{ ucfirst($participant->payment_status) }}
                                        </span>

                                    @endif

                                </td>

                                <td>
                                    <span class="badge bg-primary rounded-pill px-3">
                                        {{ $participant->payment_method }}
                                    </span>
                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

        <div class="card border-0 shadow-sm">

            <div class="card-header bg-white border-bottom">
                <h4 class="fw-semibold text-primary mb-0">
                    <i class="bi bi-pencil-square me-2"></i>
                    Información del Participante
                </h4>
            </div>

            <div class="card-body">

                <form method="POST" action="{{ route('admin.participants.update', $participant->id) }}">

                    @csrf
                    @method('PUT')

                    <input type="hidden" name="event_id" value="{{ $event->id ?? 1 }}">

                    <div class="row g-4">

                        <div class="col-md-6">
                            <label class="form-label fw-semibold"> Nombre </label>
                            <input type="text" class="form-control" name="full_name" value="{{ old('full_name', $participant->full_name) }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold"> DNI </label>
                            <input type="number" class="form-control" name="dni" value="{{ old('dni', $participant->dni) }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold"> Email </label>
                            <input type="email" class="form-control" name="email" value="{{ old('email', $participant->email) }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold"> Rol </label>
                            <select class="form-select" name="role" required>
                                <option value="profesor" {{ old('role', $participant->role) == 'profesor' ? 'selected' : '' }}>Profesor</option>
                                <option value="alumno" {{ old('role', $participant->role) == 'alumno' ? 'selected' : '' }}>Alumno</option>
                                <option value="oyente" {{ old('role', $participant->role) == 'oyente' ? 'selected' : '' }}>Oyente</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold"> Modalidad </label>
                            <select class="form-select" name="modality" required>
                                <option value="in_person" {{ old('modality', $participant->modality) == 'in_person' ? 'selected' : '' }}>Presencial</option>
                                <option value="virtual" {{ old('modality', $participant->modality) == 'virtual' ? 'selected' : '' }}>Virtual</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold"> Estado de Pago </label>
                            <select class="form-select" name="payment_status" required>
                                <option value="pending" {{ old('payment_status', $participant->payment_status) == 'pending' ? 'selected' : '' }}>Pendiente</option>
                                <option value="approved" {{ old('payment_status', $participant->payment_status) == 'approved' ? 'selected' : '' }}>Aprobado</option>
                                <option value="rejected" {{ old('payment_status', $participant->payment_status) == 'rejected' ? 'selected' : '' }}>Rechazado</option>
                                <option value="refunded" {{ old('payment_status', $participant->payment_status) == 'refunded' ? 'selected' : '' }}>Reembolsado</option>
                                <option value="charged_back" {{ old('payment_status', $participant->payment_status) == 'charged_back' ? 'selected' : '' }}>Cobrado de nuevo</option>
                                <option value="cancelled" {{ old('payment_status', $participant->payment_status) == 'cancelled' ? 'selected' : '' }}>Cancelado</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold"> Método de Pago </label>
                            <input type="text" class="form-control" name="payment_method" value="{{ old('payment_method', $participant->payment_method) }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold"> ID Externo </label>
                            <input type="text" class="form-control" name="payment_external_id" value="{{ old('payment_external_id', $participant->payment_external_id) }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold"> QR Token </label>
                            <input type="text" class="form-control" name="qr_token" value="{{ old('qr_token', $participant->qr_token) }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold"> Check-in </label>
                            <input type="text" class="form-control" name="checkin_confirmed" value="{{ old('checkin_confirmed', $participant->checkin_confirmed) }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold"> Código de Acceso </label>
                            <input type="text" class="form-control" name="access_code" value="{{ old('access_code', $participant->access_code) }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold"> Preguntas Completadas </label>
                            <select class="form-select" name="questions_completed" required>
                                <option value="1" {{ old('questions_completed', $participant->questions_completed) == 1 ? 'selected' : '' }}>Sí</option>
                                <option value="0" {{ old('questions_completed', $participant->questions_completed) == 0 ? 'selected' : '' }}>No</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold"> Registrado </label>
                            <input type="text" class="form-control" name="registered_at" value="{{ old('registered_at', $participant->registered_at) }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold"> Pagado </label>
                            <input type="text" class="form-control" name="paid_at" value="{{ old('paid_at', $participant->paid_at) }}">
                        </div>

                    </div>

                    <div class="d-flex flex-wrap justify-content-end gap-2 mt-4 pt-3 border-top">

                        <a href="{{ route('admin.participants.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                            <i class="bi bi-arrow-left me-1"></i>
                            Volver
                        </a>

                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                            <i class="bi bi-check-circle me-1"></i>
                            Actualizar Participante
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</section>

@endsection