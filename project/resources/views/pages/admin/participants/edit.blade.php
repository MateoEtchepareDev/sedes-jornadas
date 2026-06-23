@extends('layouts.app', [
    'edit' => true 
    ]) 

@section('edit')

<div class="form-wrapper">

        <h1 class="form-heading">
            Editar Participante
        </h1>

        <div class="table-responsive">
            <table class="table table-sm table-bordered participant-table mb-4">
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
                        <td>{{ $participant->event_id }}</td>
                        <td>{{ $participant->full_name }}</td>
                        <td>{{ $participant->dni }}</td>
                        <td>{{ $participant->email }}</td>
                        <td>{{ $participant->role }}</td>
                        <td>{{ $participant->modality }}</td>
                        <td>{{ $participant->payment_status }}</td>
                        <td>{{ $participant->payment_method }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <br><br>

        <div class="form-box">

        <form method="POST" action="{{ route('admin.participants.update', $participant->id) }}">

            @csrf
            @method('PUT')

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
                        value="{{ old('full_name', $participant->full_name) }}"
                        required
                    >
                </div>

                <div class="field-group">
                    <label class="field-label">DNI</label>
                    <input 
                        class="field-input"
                        type="number"
                        name="dni"
                        value="{{ old('dni', $participant->dni) }}"
                        required
                    >
                </div>

                <div class="field-group">
                    <label class="field-label">Email</label>
                    <input 
                        class="field-input"
                        type="email"
                        name="email"
                        value="{{ old('email', $participant->email) }}"
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
                        <option value="profesor" {{ old('role', $participant->role) == 'profesor' ? 'selected' : '' }}>
                            Profesor
                        </option>

                        <option value="alumno" {{ old('role', $participant->role) == 'alumno' ? 'selected' : '' }}>
                            Alumno
                        </option>

                        <option value="oyente" {{ old('role', $participant->role) == 'oyente' ? 'selected' : '' }}>
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
                        <option value="in_person" {{ old('modality', $participant->modality) == 'in_person' ? 'selected' : '' }}>Presencial</option>
                        <option value="virtual" {{ old('modality', $participant->modality) == 'virtual' ? 'selected' : '' }}>Virtual</option>

                    </select>
                </div>

                <div class="field-group">
                    <label class="field-label">Estado de Pago</label>
                    <select 
                        class="field-select"
                        name="payment_status"
                        required
                    >

                        <option value="pending" {{ old('payment_status', $participant->payment_status) == 'pending' ? 'selected' : '' }}>Pendiente</option>
                        <option value="approved" {{ old('payment_status', $participant->payment_status) == 'approved' ? 'selected' : '' }}>Aprobado</option>
                        <option value="rejected" {{ old('payment_status', $participant->payment_status) == 'rejected' ? 'selected' : '' }}>Rechazado</option>
                        <option value="refunded" {{ old('payment_status', $participant->payment_status) == 'refunded' ? 'selected' : '' }}>Reembolsado</option>
                        <option value="charged_back" {{ old('payment_status', $participant->payment_status) == 'charged_back' ? 'selected' : '' }}>Cobrado de nuevo</option>
                        <option value="cancelled" {{ old('payment_status', $participant->payment_status) == 'cancelled' ? 'selected' : '' }}>Cancelado</option>
                    </select>
                </div>

                <div class="field-group">
                    <label class="field-label">Método de Pago</label>
                    <input 
                        class="field-input"
                        type="text"
                        name="payment_method"
                        value="{{ old('payment_method', $participant->payment_method) }}"
                        required
                    >
                </div>

                <div class="field-group">
                    <label class="field-label">ID Externo</label>
                    <input 
                        class="field-input"
                        type="text"
                        name="payment_external_id"
                        value="{{ old('payment_external_id', $participant->payment_external_id) }}"
                    >
                </div>

                <div class="field-group">
                    <label class="field-label">QR Token</label>
                    <input 
                        class="field-input"
                        type="text"
                        name="qr_token"
                        value="{{ old('qr_token', $participant->qr_token) }}"
                    >
                </div>

                <div class="field-group">
                    <label class="field-label">Check-in</label>
                    <input 
                        class="field-input"
                        type="text"
                        name="checkin_confirmed"
                        value="{{ old('checkin_confirmed', $participant->checkin_confirmed) }}"
                    >
                </div>

                <div class="field-group">
                    <label class="field-label">Código de Acceso</label>
                    <input 
                        class="field-input"
                        type="text"
                        name="access_code"
                        value="{{ old('access_code', $participant->access_code) }}"
                    >
                </div>

                <div class="field-group">
                    <label class="field-label">Preguntas Completadas</label>
                    <select 
                        class="field-select"
                        name="questions_completed"
                        required>
                        <option value="1" {{ old('questions_completed', $participant->questions_completed) == 1 ? 'selected' : '' }}>
                            Sí
                        </option>

                        <option value="0" {{ old('questions_completed', $participant->questions_completed) == 0 ? 'selected' : '' }}>
                            No
                        </option>
                    </select>
                </div>

                <div class="field-group">
                    <label class="field-label">Registrado</label>
                    <input 
                        class="field-input"
                        type="text"
                        name="registered_at"
                        value="{{ old('registered_at', $participant->registered_at) }}"
                    >
                </div>

                <div class="field-group">
                    <label class="field-label">Pagado</label>
                    <input 
                        class="field-input"
                        type="text"
                        name="paid_at"
                        value="{{ old('paid_at', $participant->paid_at) }}"
                    >
                </div>

            </div>

            <div class="submit-zone d-flex flex-wrap gap-2 mt-3">
                <button type="submit" class="btn btn-primary">
                    Actualizar Participante
                </button>
                <a href="{{ route('admin.participants.index') }}" class="btn btn-secondary">
                    Volver al listado
                </a>
            </div>

        </form>

    </div>

</div>

@endsection