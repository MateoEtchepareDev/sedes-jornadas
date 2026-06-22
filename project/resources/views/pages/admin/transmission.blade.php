@extends('layouts.app')

@section('content')

<div style="display:flex; gap:20px; padding:20px;">

    <div style="flex:3;">

        <h1>Panel de transmisión</h1>

        <iframe
            width="100%"
            height="500"
            src="https://www.youtube.com/embed/dQw4w9WgXcQ"
            allowfullscreen>
        </iframe>

    </div>


    <div style="flex:1; border-left:1px solid #ccc; padding-left:20px;">

        <h2>Preguntas en vivo</h2>

        @forelse($comments as $comment)

            <div style="
                border:1px solid #ddd;
                padding:10px;
                margin-bottom:10px;
                border-radius:8px;
            ">

                {{ $comment->message }}

            </div>

        @empty

            <p>No hay preguntas todavía.</p>

        @endforelse

    </div>

</div>

<script>
    setTimeout(function () {
        location.reload();
    }, 30000);
</script>

@endsection