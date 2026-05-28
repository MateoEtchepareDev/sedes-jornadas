@extends('layouts.app', [
    'inscripcion' => true
])

@section('form')

<section class="form-wrapper">

    <div class="form-box">

        <h1 class="form-heading">
            Formulario de Inscripción
        </h1>


        @if ($errors->any())

            <div>

                @foreach ($errors->all() as $error)

                    <p>{{ $error }}</p>

                @endforeach

            </div>

        @endif

        <form method="POST" action="{{ route('participants.store') }}">

        @csrf


            <div class="form-grid">

                <div class="field-group">

                    <label class="field-label">
                        Nombre Completo
                    </label>

                    <input
                        type="text"
                        class="field-input"
                        name="full_name"
                        required>

                </div>

                <div class="field-group">

                    <label class="field-label">
                        DNI
                    </label>

                    <input
                        type="text"
                        class="field-input"
                        name="dni"
                        required>

                </div>

                <div class="field-group">

                    <label class="field-label">
                        Email
                    </label>

                    <input
                        type="email"
                        class="field-input"
                        name="email"
                        required>

                </div>

                <div class="field-group">

                    <label class="field-label">
                        Rol
                    </label>

                    <select 
                    class="field-select"
                    name="role">

                        <option
                            value="profesor">
                            Profesor
                        </option>

                        <option
                            value="alumno">
                            Alumno
                        </option>

                        <option
                            value="oyente">
                            Oyente
                        </option>

                    </select>

                </div>

                <div class="field-group">

                    <label class="field-label">
                        Certificado
                    </label>

                    <div class="option-row">

                        <label class="option-btn">

                            <input
                                type="radio"
                                name="modality"
                                value="in_person"
                                hidden>

                                FISICO

                        </label>

                        <label class="option-btn">

                            <input
                                type="radio"
                                name="modality"
                                value="virtual"
                                hidden>

                                VIRTUAL

                        </label>

                    </div>

                </div>

            </div>

            <div class="payment-row">

                <label class="payment-card">

                    <input
                        type="radio"
                        name="payment_method"
                        value="mercado_pago"
                        hidden>

                    <span>
                        Mercado Pago
                    </span>

                </label>

                <label class="payment-card">

                    <input
                        type="radio"
                        name="payment_method"
                        value="cash"
                        hidden>

                    <span>
                        Efectivo
                    </span>

                </label>

            </div>

            <input
                type="hidden"
                name="event_id"
                value="{{ $event->id ?? 1 }}">

            <input
                type="hidden"
                name="payment_status"
                value="pending">

            <div class="submit-zone">

                <button
                    type="submit"
                    class="submit-btn">

                    Inscribirse

                </button>

            </div>

        </form>

    </div>

</section>

@endsection