@extends('layouts.app', [
    'inscripcion' => true
])

@section('form')

<section class="form-wrapper">

    <div class="form-box">

        <h1 class="form-heading">
            Formulario de Inscripción
        </h1>

        <form>

            <div class="form-grid">

                <div class="field-group">

                    <label class="field-label">
                        Nombre Completo
                    </label>

                    <input
                        type="text"
                        class="field-input">

                </div>

                <div class="field-group">

                    <label class="field-label">
                        DNI
                    </label>

                    <input
                        type="text"
                        class="field-input">

                </div>

                <div class="field-group">

                    <label class="field-label">
                        Email
                    </label>

                    <input
                        type="email"
                        class="field-input">

                </div>

                <div class="field-group">

                    <label class="field-label">
                        Rol
                    </label>

                    <select class="field-select">

                        <option>
                            Profesor
                        </option>

                        <option>
                            Alumno
                        </option>

                        <option>
                            Oyente
                        </option>

                    </select>

                </div>

                <div class="field-group">

                    <label class="field-label">
                        Teléfono
                    </label>

                    <input
                        type="text"
                        class="field-input">

                </div>

                <div class="field-group">

                    <label class="field-label">
                        Certificado
                    </label>

                    <div class="option-row">

                        <button
                            type="button"
                            class="option-btn">

                            FISICO

                        </button>

                        <button
                            type="button"
                            class="option-btn">

                            VIRTUAL

                        </button>

                    </div>

                </div>

            </div>

            <div class="payment-row">

                <div class="payment-card">

                    <span>
                        Mercado Pago
                    </span>

                </div>

                <div class="payment-card">

                    <span>
                        Efectivo
                    </span>

                </div>

            </div>

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