@extends('layouts.app', [
    'transmission' => true
])

@section('stream')

<section class="stream-section py-5">

    <div class="container">

        <div class="stream-card">

            <div class="d-flex justify-content-center mb-3">
                <div class="live-badge">
                    <span class="live-dot"></span>
                    EN VIVO
                </div>
            </div>

            <h1 class="stream-title">
                Transmisión de la Jornada {{ $event->title }}
            </h1>

            <p class="stream-subtitle">
                Sigue la transmisión en vivo del evento en tiempo real.
            </p>

            <div class="video-wrapper mb-4">

                <iframe
                    src="{{ $event->stream_url }}?autoplay=1&mute=1&rel=0&modestbranding=1&playsinline=1"
                    allow="autoplay"
                    frameborder="0"
                    allowfullscreen>
                </iframe>

                <div class="cover-top-left"></div>
                <div class="cover-bottom-left"></div>
                <div class="cover-bottom-right"></div>

            </div>

            <div class="comments-card">

                <h4 class="comments-title">
                    Comentarios y Preguntas
                </h4>

                <form action="/comments" method="POST">
                    @csrf
                    <textarea
                        name="message"
                        class="form-control mb-3"
                        rows="5"
                        placeholder="Escribí tu pregunta o comentario..."
                        required
                    ></textarea>

                    <input type="hidden" name="participant_id" value="{{ session('participant_id') }}">
                    <input type="hidden" name="full_name" value="{{ session('participant_name') }}">
                    

                    <div class="text-center">
                        <button class="btn-send">
                            Enviar Comentario
                    </button>
                    </div>
                </form>

            </div>

        </div>

    </div>

</section>

@endsection