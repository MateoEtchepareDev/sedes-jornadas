@extends('layouts.app', [
    'inscripcion' => true
])

@section('form')

<section class="form-wrapper">

    <div class="container">

        <div class="status-box success-status">

            <div class="status-icon success-icon">
                <i class="bi bi-check-circle-fill"></i>
            </div>

            <h1 class="status-title">
                ¡Inscripción Exitosa!
            </h1>

            <p class="status-message">
                Su pago ha sido recibido correctamente.
            </p>

            <div class="status-info">

                <p>
                    Gracias por inscribirse a la jornada.
                </p>

                <strong><p>
                    Próximamente recibirá un correo electrónico con:
                </p>

                <ul>
                    <li>Información importante del evento</li>
                    <li>Horario y modalidad</li>
                    <li>Datos adicionales de ingreso</li>
                </ul></strong>

            </div>

            <a href="{{ config('app.url') }}" class="btn status-btn">
                Volver al inicio
            </a>

        </div>

    </div>

</section>

@endsection
