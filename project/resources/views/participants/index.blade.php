@extends('layouts.app', [
    'inscripcion' => true
])

@section('form')

<section class="form-wrapper">

    <div class="form-box">

        <h1 class="form-heading">
            Participantes Registrados
        </h1>

        @if(session('success'))

            <div class="success-alert">

                {{ session('success') }}

            </div>

        @endif

        <div class="participants-grid">

            @foreach($participants as $participant)

                <div class="participant-card">

                    <div class="field-group">

                        <label class="field-label">
                            Nombre Completo
                        </label>

                        <div class="field-display">

                            {{ $participant->full_name }}

                        </div>

                    </div>

                    <div class="field-group">

                        <label class="field-label">
                            Email
                        </label>

                        <div class="field-display">

                            {{ $participant->email }}

                        </div>

                    </div>

                    <div class="field-group">

                        <label class="field-label">
                            DNI
                        </label>

                        <div class="field-display">

                            {{ $participant->dni }}

                        </div>

                    </div>

                    <div class="field-group">

                        <label class="field-label">
                            Rol
                        </label>

                        <div class="field-display">

                            {{ ucfirst($participant->role) }}

                        </div>

                    </div>

                    <div class="field-group">

                        <label class="field-label">
                            Modalidad
                        </label>

                        <div class="field-display">

                            {{ $participant->modality == 'virtual' ? 'Virtual' : 'Presencial' }}

                        </div>

                    </div>

                    <div class="field-group">

                        <label class="field-label">
                            Método de Pago
                        </label>

                        <div class="field-display">

                            {{ $participant->payment_method == 'mercado_pago' ? 'Mercado Pago' : 'Efectivo' }}

                        </div>

                    </div>

                </div>

            @endforeach

        </div>
        
            <a href="{{ route('participants.edit', $participant->id) }}">
                editar participante
            </a>

    </div>

</section>

@endsection