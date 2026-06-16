@extends('layouts.app', [
    'edit' => true 
    ]) 

@section('edit')
<div class="form-wrapper">

    <div class="form-box">

        <h1 class="form-heading">
            Nuevo Participante
        </h1>
        @if ($errors->any())
            <div style="color:red">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('/participants.storeCrud') }}">

            @csrf

            <div class="form-grid">

            <input
                type="hidden"
                name="event_id"
                value="{{ $event->id ?? 1 }}">
            
                <div class="field-group">
                    <label class="field-label">Nombre</label>
                    <input 
                        class="field-input"
                        type="text"
                        name="full_name"
                        required
                    >
                </div>

                <div class="field-group">
                    <label class="field-label">DNI</label>
                    <input 
                        class="field-input"
                        type="number"
                        name="dni"
                        required
                    >
                </div>

                <div class="field-group">
                    <label class="field-label">Email</label>
                    <input 
                        class="field-input"
                        type="email"
                        name="email"
                        required
                    >
                </div>

                <div class="field-group">
                    <label class="field-label">Rol</label>
                    <select 
                        class="field-select"
                        name="role"
                        required
                    >
                        <option value="profesor">
                            Profesor
                        </option>

                        <option value="alumno">
                            Alumno
                        </option>

                        <option value="oyente">
                            Oyente
                        </option>
                    </select>
                </div>

                <div class="field-group">
                    <label class="field-label">Modalidad</label>
                    <select 
                        class="field-select"
                        name="modality"
                        required
                    >
                        <option value="in_person">Presencial</option>
                        <option value="virtual">Virtual</option>

                    </select>
                </div>

                <div class="field-group">
                    <label class="field-label">Estado de Pago</label>
                    <select 
                        class="field-select"
                        name="payment_status"
                        required
                    >

                        <option value="pending">Pendiente</option>
                        <option value="approved">Aprobado</option>
                        <option value="rejected">Rechazado</option>
                        <option value="refunded">Reembolsado</option>
                        <option value="charged_back">Cobrado de nuevo</option>
                        <option value="cancelled">Cancelado</option>
                    </select>
                </div>

                <div class="field-group">
                    <label class="field-label">Método de Pago</label>
                    <select 
                        class="field-select"
                        name="payment_method"
                        required>
                        <option value="cash">
                            Efectivo
                        </option>

                        <option value="mercado_pago">
                            Mercado Pago
                        </option>
                    </select>
                </div>

                <div class="field-group">
                    <label class="field-label">ID Externo</label>
                    <input 
                        class="field-input"
                        type="text"
                        name="payment_external_id"
                    >
                </div>

                <div class="field-group">
                    <label class="field-label">QR Token</label>
                    <input 
                        class="field-input"
                        type="text"
                        name="qr_token"
                    >
                </div>

                <div class="field-group">
                    <label class="field-label">Check-in</label>
                    <select 
                        class="field-select"
                        name="checkin_confirmed"
                        required>
                        <option value="1">
                            Sí
                        </option>

                        <option value="0">
                            No
                        </option>
                    </select>
                </div>

                <div class="field-group">
                    <label class="field-label">Código de Acceso</label>
                    <input 
                        class="field-input"
                        type="text"
                        name="access_code"
                    >
                </div>

                <div class="field-group">
                    <label class="field-label">Preguntas Completadas</label>
                    <select 
                        class="field-select"
                        name="questions_completed"
                        required>
                        <option value="1">
                            Sí
                        </option>

                        <option value="0">
                            No
                        </option>
                    </select>
                </div>

                <div class="field-group">
                    <label class="field-label">Registrado</label>
                    <input type="datetime-local" name="registered_at">
                </div>

                <div class="field-group">
                    <label class="field-label">Pagado</label>
                    <input type="datetime-local" name="paid_at">
                </div>

            </div>

            <div class="submit-zone d-flex flex-wrap gap-2 mt-3">
                <button type="submit" class="btn btn-primary">
                    Crear Participante
                </button>
                <a href="{{ route('participants.index') }}" class="btn btn-secondary">
                    Volver al listado
                </a>
            </div>

        </form>

    </div>

</div>

@endsection
