@extends('layouts.app', [
    'inscripcion' => true
])

@section('form')

<section class="form-wrapper">
    
    <div class="container">
        <div class="form-box">

            <h1 class="form-heading">¡Gracias por completar el formulario!</h1>

            <p class="success-message">Tu inscripción ha sido registrada correctamente. En breve recibirás un correo de confirmación con los detalles de tu participación.</p>

        </div>
        
    </div>
</section>

@endsection