@extends('layouts.app', [
    'transmission' => true
])

@section('stream')

<div class="container py-5">
    <div class="row g-4">

        {{-- Video --}}
        <div class="col-lg-8">

            <div class="card shadow-sm border-0 rounded-4 overflow-hidden">

                <div class="ratio ratio-16x9">
                    <iframe
                        src="{{$event->stream_url}}?autoplay=1&mute=1&rel=0&modestbranding=1&playsinline=1"
                        allow="autoplay"
                        frameborder="0"
                        allowfullscreen>
                    </iframe>
                </div>

            </div>

        </div>

        {{-- Preguntas --}}
        <div class="col-lg-4">

            <div class="card shadow-sm border-0 rounded-4 h-100">

                <div class="card-header bg-primary text-white fw-bold">
                    💬 Preguntas en vivo
                </div>

                <div class="card-body"
                     style="max-height: 600px; overflow-y: auto;">

                    @forelse($comments as $comment)

                        <div class="comment-card mb-3">
                             <div>
                                <strong>{{$comment->participant->full_name }}</strong>
                                {{ $comment->created_at->format('H:i') }}
                            </div>

                            <div>
                                {{ $comment->message }}
                            </div>

                        </div>

                    @empty

                        <div class="alert alert-light text-center">
                            No hay preguntas todavía.
                        </div>

                    @endforelse

                </div>

            </div>

        </div>

    </div>

</div>

<style>

.comment-card{
    background:#f8f9fa;
    border-left:4px solid #0d6efd;
    padding:12px;
    border-radius:10px;
    transition:.2s;
}

.comment-card:hover{
    background:#eef5ff;
}

.card{
    transition:.2s;
}

.card:hover{
    transform:translateY(-2px);
}

</style>

<script>
    setTimeout(function () {
        location.reload();
    }, 30000);
</script>

@endsection