@extends('layouts.app', [
    'inscripcion' => true
])

@section('form')

<section class="form-wrapper">

    <div class="container">

        <div class="status-box failed-status">

            <div class="status-icon failed-icon">
                <i class="bi bi-x-circle-fill"></i>
            </div>

            <h1 class="status-title"> Pago Rechazado </h1>

            <p class="status-message">
                No se pudo completar el pago.
            </p>

            <div class="status-info">

                <p>
                    Verifique los datos ingresados o pruebe
                    con otro método de pago.
                </p>

                <p>
                    La inscripción todavía no fue confirmada.
                </p>

            </div>

            <a href="{{ url('/inscripcion') }}" class="btn status-btn">
                Intentar nuevamente
            </a>

        </div>

    </div>

</section>

@endsection

