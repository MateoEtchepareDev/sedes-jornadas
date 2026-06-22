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
                Transmisión de la Jornada {{ $event->title}}
            </h1>

            <iframe width="560" 
            height="315" 
            src="{{ $event->stream_url }}" 
            title="YouTube video player" 
            frameborder="0" 
            allow="accelerometer; 
            autoplay; clipboard-write; 
            encrypted-media; gyroscope; 
            picture-in-picture; 
            web-share" 
            referrerpolicy="strict-origin-when-cross-origin" 
            allowfullscreen></iframe>

            <p class="stream-subtitle">
                Sigue la transmisión en vivo del evento en tiempo real.
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