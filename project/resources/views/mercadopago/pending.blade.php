@extends('layouts.app', [
    'inscripcion' => true
])

@section('form')

<section class="form-wrapper">

    <div class="container">

        <div class="status-box pending-status">

            <div class="status-icon pending-icon">
                <i class="bi bi-clock-fill"></i>
            </div>

            <h1 class="status-title">
                Pago Pendiente
            </h1>

            <p class="status-message">
                Estamos esperando la confirmación del pago.
            </p>

            <div class="status-info">

                <p>
                    Su inscripción fue registrada correctamente.
                </p>

                <p>
                    Una vez acreditado el pago,
                    la inscripción quedará confirmada automáticamente.
                </p>

            </div>

            <a href="{{ config('app.url') }}" class="btn status-btn">
                Volver al inicio
            </a>

        </div>

    </div>

</section>

@endsection
