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
                Transmisión de la Jornada {{ $event->name}}
            </h1>

            <p class="stream-subtitle">
                Sigue la transmisión en vivo del evento en tiempo real.
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