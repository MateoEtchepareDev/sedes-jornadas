@extends('layouts.app', [
    'transmission' => true
])

@section('stream')

<section class="stream-layout">
    <div class="stream-video">

        <div class="video-wrapper">

            <iframe
                src="{{ $event->stream_url }}?autoplay=1&mute=1&rel=0&modestbranding=1&playsinline=1"
                allow="autoplay"
                frameborder="0"
                allowfullscreen>
            </iframe>

            <div class="cover cover-top"></div>
            <div class="cover cover-bottom-left"></div>
            <div class="cover cover-bottom-right"></div>

        </div>

    </div>

    <div class="stream-chat">

        <div class="chat-header">
            Comentarios y Preguntas
        </div>

        <form action="/comments" method="POST" class="chat-form">
            @csrf

            <textarea
                name="message"
                placeholder="Escribí tu pregunta o comentario..."
                required></textarea>

            <input type="hidden" name="participant_id" value="{{ session('participant_id') }}">
            <input type="hidden" name="full_name" value="{{ session('participant_name') }}">

            <button type="submit">
                Enviar Comentario
            </button>

        </form>

    </div>

</section>
<script>

        localStorage.setItem(
        'participant_id',
        '{{ session("participant_id") }}'
    );

</script>
@endsection