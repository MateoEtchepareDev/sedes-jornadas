@extends('layouts.app', [
    'edit' => true 
    ]) 

@section('edit')

<div class="form-wrapper">

    <div class="form-box">

        <h1 class="form-heading">
            Participante
        </h1>

        <table class="participant-table">
            <thead>
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
                    <td>{{ $participant['event_id'] }}</td>
                    <td>{{ $participant['full_name'] }}</td>
                    <td>{{ $participant['dni'] }}</td>
                    <td>{{ $participant['email'] }}</td>
                    <td>{{ $participant['role'] }}</td>
                    <td>{{ $participant['modality'] }}</td>
                    <td>{{ $participant['payment_status'] }}</td>
                    <td>{{ $participant['payment_method'] }}</td>
                </tr>
            </tbody>
        </table>

        <br><br>

        <form method="POST" action="{{ route('participants.update', $participant->id) }}">

            @csrf
            @method('PUT')

            <div class="form-grid">

                <div class="field-group">
                    <label class="field-label">Nombre</label>
                    <input 
                        class="field-input"
                        type="text"
                        name="full_name"
                        value="{{ $participant->full_name }}"
                        required
                    >
                </div>

                <div class="field-group">
                    <label class="field-label">DNI</label>
                    <input 
                        class="field-input"
                        type="number"
                        name="dni"
                        value="{{ $participant->dni }}"
                        required
                    >
                </div>

                <div class="field-group">
                    <label class="field-label">Email</label>
                    <input 
                        class="field-input"
                        type="email"
                        name="email"
                        value="{{ $participant->email }}"
                        required
                    >
                </div>

                <div class="field-group">
                    <label class="field-label">Rol</label>
                    <select 
                        class="field-select"
                        name="role"
                        value="{{ $participant->role }}"
                        required
                    >
                        <option value="participant" {{ $participant->role == 'participant' ? 'selected' : '' }}>Participant</option>
                        <option value="admin" {{ $participant->role == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>

                <div class="field-group">
                    <label class="field-label">Modalidad</label>
                    <select 
                        class="field-select"
                        name="modality"
                        value="{{ $participant->modality }}"
                        required
                    >
                        <option value="presencial" {{ $participant->modality == 'presencial' ? 'selected' : '' }}>Presencial</option>
                        <option value="virtual" {{ $participant->modality == 'virtual' ? 'selected' : '' }}>Virtual</option>

                    </select>
                </div>

                <div class="field-group">
                    <label class="field-label">Estado de Pago</label>
                    <select 
                        class="field-select"
                        name="payment_status"
                        value="{{ $participant->payment_status }}"
                        required
                    >

                        <option value="pending" {{ $participant->payment_status == 'pending' ? 'selected' : '' }}>Pendiente</option>
                        <option value="paid" {{ $participant->payment_status == 'paid' ? 'selected' : '' }}>Pagado</option>
                        <option value="cancelled" {{ $participant->payment_status == 'cancelled' ? 'selected' : '' }}>Cancelado</option>

                    </select>
                </div>

                <div class="field-group">
                    <label class="field-label">Método de Pago</label>
                    <input 
                        class="field-input"
                        type="text"
                        name="payment_method"
                        value="{{ $participant->payment_method }}"
                        required
                    >
                </div>

                <div class="field-group">
                    <label class="field-label">ID Externo</label>
                    <input 
                        class="field-input"
                        type="text"
                        name="payment_external_id"
                        value="{{ $participant->payment_external_id }}"
                    >
                </div>

                <div class="field-group">
                    <label class="field-label">QR Token</label>
                    <input 
                        class="field-input"
                        type="text"
                        name="qr_token"
                        value="{{ $participant->qr_token }}"
                    >
                </div>

                <div class="field-group">
                    <label class="field-label">Check-in</label>
                    <input 
                        class="field-input"
                        type="text"
                        name="checkin_confirmed"
                        value="{{ $participant->checkin_confirmed }}"
                    >
                </div>

                <div class="field-group">
                    <label class="field-label">Código de Acceso</label>
                    <input 
                        class="field-input"
                        type="text"
                        name="access_code"
                        value="{{ $participant->access_code }}"
                    >
                </div>

                <div class="field-group">
                    <label class="field-label">Preguntas Completadas</label>
                    <select 
                        class="field-select"
                        type="boolean"
                        name="questions_completed"
                        value="{{ $participant->questions_completed }}"
                    >

                        <option value="1" {{ $participant->questions_completed ? 'selected' : '' }}>Sí</option>
                        <option value="0" {{ !$participant->questions_completed ? 'selected' : '' }}>No</option>

                    </select>
                </div>

                <div class="field-group">
                    <label class="field-label">Registrado</label>
                    <input 
                        class="field-input"
                        type="text"
                        name="registered_at"
                        value="{{ $participant->registered_at }}"
                    >
                </div>

                <div class="field-group">
                    <label class="field-label">Pagado</label>
                    <input 
                        class="field-input"
                        type="text"
                        name="paid_at"
                        value="{{ $participant->paid_at }}"
                    >
                </div>

            </div>

            <div class="submit-zone">
                <button type="submit" class="submit-btn">
                    Actualizar Participante
                </button>
            </div>

        </form>

    </div>

</div>

@endsection