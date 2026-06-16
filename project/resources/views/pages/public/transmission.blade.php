@extends('layouts.app', [
    'transmission' => true
])

@section('stream')

<section class="stream-section">

    <div class="stream-container">

        <div class="stream-card">

            <div class="live-badge">
                <span class="live-dot"></span>
                EN VIVO
            </div>

            <h1 class="stream-title">
                Transmisión de la Jornada
            </h1>

            <p class="stream-subtitle">
                Sigue la transmisión en vivo del evento en tiempo real.
            </p>

            <div class="stream-video-wrapper">

                <iframe 
                    src="https://www.youtube.com/embed/dQw4w9WgXcQ"
                    title="YouTube video player"
                    allowfullscreen>
                </iframe>

            </div>

            <div class="stream-info">

                <h3>
                    Información de la transmisión
                </h3>

                <p>
                    La transmisión comenzará automáticamente cuando el evento esté en vivo.
                    Si tienes problemas de reproducción, actualiza la página o verifica tu conexión a internet.
                </p>

                <form action="/comments" method="POST">
                @csrf

                <textarea
                    name="message"
                    placeholder="Escribí tu pregunta o comentario..."
                    required
                ></textarea>

                <button type="submit">
                    Enviar
                </button>
            </form>

            </div>

        </div>

    </div>

</section>

@endsection