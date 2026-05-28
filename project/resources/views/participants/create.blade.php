@extends('layouts.app', [
    'inscripcion' => true
])

@section('form')

<section class="form-wrapper">

    <div class="form-box">

        <h1 class="form-heading">Nuevo participante</h1>

        <p class="text-muted mb-4">Completá los datos para registrar un participante desde el panel.</p>

        <form method="POST" action="{{ route('participants.store') }}">

            @csrf

            @php
                $events = \App\Models\Events::all();
            @endphp

            <div class="row g-3">

                <div class="col-md-6">
                    <label class="field-label">Evento</label>
                    <select name="event_id" class="form-select field-select" required>
                        @foreach($events as $event)
                            <option value="{{ $event->id }}">{{ $event->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="field-label">Nombre completo</label>
                    <input type="text" name="full_name" class="form-control field-input" required>
                </div>

                <div class="col-md-6">
                    <label class="field-label">DNI</label>
                    <input type="text" name="dni" class="form-control field-input" required>
                </div>

                <div class="col-md-6">
                    <label class="field-label">Email</label>
                    <input type="email" name="email" class="form-control field-input" required>
                </div>

                <div class="col-md-6">
                    <label class="field-label">Rol</label>
                    <select name="role" class="form-select field-select" required>
                        <option value="profesor">Profesor</option>
                        <option value="alumno">Alumno</option>
                        <option value="oyente">Oyente</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="field-label">Modalidad</label>
                    <select name="modality" class="form-select field-select" required>
                        <option value="in_person">Presencial</option>
                        <option value="virtual">Virtual</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="field-label">Estado de pago</label>
                    <select name="payment_status" class="form-select field-select" required>
                        <option value="pending">Pendiente</option>
                        <option value="approved">Aprobado</option>
                        <option value="rejected">Rechazado</option>
                        <option value="refunded">Reintegrado</option>
                        <option value="charged_back">Chargeback</option>
                        <option value="cancelled">Cancelado</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="field-label">Método de pago</label>
                    <select name="payment_method" class="form-select field-select" required>
                        <option value="mercado_pago">Mercado Pago</option>
                        <option value="cash">Efectivo</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="field-label">ID externo</label>
                    <input type="text" name="payment_external_id" class="form-control field-input">
                </div>

                <div class="col-md-6">
                    <label class="field-label">QR token</label>
                    <input type="text" name="qr_token" class="form-control field-input">
                </div>

                <div class="col-md-6">
                    <label class="field-label">Código de acceso</label>
                    <input type="text" name="access_code" class="form-control field-input">
                </div>

                <div class="col-md-6">
                    <label class="field-label">Check-in confirmado</label>
                    <select name="checkin_confirmed" class="form-select field-select">
                        <option value="1">Sí</option>
                        <option value="0" selected>No</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="field-label">Preguntas completadas</label>
                    <select name="questions_completed" class="form-select field-select">
                        <option value="1">Sí</option>
                        <option value="0" selected>No</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="field-label">Registrado en</label>
                    <input type="datetime-local" name="registered_at" class="form-control field-input">
                </div>

                <div class="col-md-6">
                    <label class="field-label">Pagado en</label>
                    <input type="datetime-local" name="paid_at" class="form-control field-input">
                </div>

            </div>

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary">Guardar participante</button>
                <a href="{{ route('participants.index') }}" class="btn btn-outline-secondary">Volver</a>
            </div>

        </form>

    </div>

</section>

@endsection
