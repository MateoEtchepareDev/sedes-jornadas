@extends('layouts.app', [
    'inscripcion' => true
])

@section('form')

<section class="form-wrapper">
    <div class="container">
        <div class="form-box">

            <h1 class="form-heading">Formulario de Inscripción</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form id="inscription-form" method="POST" action="participants.storeFormulario">
                @csrf

                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="field-label">Nombre Completo</label>
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
                        <select name="role" class="form-select field-select">
                            <option value="profesor">Profesor</option>
                            <option value="alumno">Alumno</option>
                            <option value="oyente">Oyente</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="field-label">Certificado</label>
                        <div class="option-row">
                            <input type="radio" id="mod_in_person" name="modality" value="in_person" class="d-none option-cetificate">
                            <label for="mod_in_person" class="option-btn btn">FISICO</label>

                            <input type="radio" id="mod_virtual" name="modality" value="virtual" class="d-none option-cetificate">
                            <label for="mod_virtual" class="option-btn btn">VIRTUAL</label>
                        </div>
                    </div>

                    <div class="col-12">
                        <label class="field-label metodoPago">Metodo de Pago</label>
                        <div class="payment-row">
                            
                            <input type="radio" id="pay_mercado" name="payment_method" value="mercado_pago" class="d-none" action="/MercadoPagoController@createPaymentPreference">
                            <label for="pay_mercado" class="payment-card btn">
                                <img class="bi bi-wallet2" src="{{ asset('images/mercadopago.png') }}"></img>
                                <span>Mercado Pago</span> 
                            </label>

                            <input type="radio" id="pay_cash" name="payment_method" value="cash" class="d-none">
                            <label for="pay_cash" class="payment-card btn">
                                <img class="bi bi-cash-stack" src="{{ asset('images/cash.png') }}"></img>
                                <span>Efectivo</span>
                            </label>
                        </div>
                    </div>

                </div>

                <input type="hidden" name="event_id" value="{{ $event->id ?? 1 }}">
                <input type="hidden" name="payment_status" value="pending">

                <div class="submit-zone">
                    <button type="submit" class="btn btn-warning submit-btn">Inscribirse</button>
                </div>
            </form>

            <div id="successMessage" style="display:none;" class="alert alert-success mt-4">
                <h4>Inscripción finalizada</h4>
                <p>Pasar por mesa a pagar.</p>
            </div>

        </div>
    </div>
</section>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://sdk.mercadopago.com/js/v2"></script>
    <script>
        window.mercadoPagoPublicKey = "{{ env('MERCADOPAGO_PUBLIC_KEY') }}";
    </script>
    <script src="{{ asset('js/inscription.js') }}"></script>

@endsection