@extends('layouts.app', ['transmission' => true])

@section('stream')

<section class="form-wrapper py-4">

    <div class="container-fluid">
        <div class="mb-4">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-primary rounded-pill">
                <i class="bi bi-arrow-left me-1"></i>
                Volver al Panel
            </a>
        </div>

        <div class="row g-4 align-items-start">
            <div class="col-xl-8">
                <div class="card border-0 shadow-sm overflow-hidden">
                    <div class="ratio ratio-16x9">
                        <iframe
                            src="{{ $event->stream_url }}?autoplay=1&mute=1&rel=0&modestbranding=1&playsinline=1"
                            allow="autoplay"
                            frameborder="0"
                            allowfullscreen>
                        </iframe>
                    </div>
                </div>

            </div>

            <div class="col-xl-4">
                <div class="card border-0 shadow-sm comments-panel">
                    <div class="card-header bg-primary text-white">
                        <div class="d-flex justify-content-between align-items-center">

                            <span class="fw-semibold">
                                <i class="bi bi-chat-left-dots-fill me-2"></i>
                                Preguntas
                            </span>

                            <span class="badge bg-light text-primary rounded-pill">
                                {{ $comments->count() }}
                            </span>
                        </div>
                    </div>

                    <div class="card-body comments-body">
                        @forelse($comments as $comment)
                            <div class="comment-card">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div>

                                        <div class="fw-semibold">
                                            <i class="bi bi-person-circle text-primary me-1"></i>
                                            {{ $comment->participant?->full_name ?? 'Participante eliminado' }}
                                        </div>

                                        <small class="text-muted">
                                            {{ $comment->created_at->format('H:i') }}
                                        </small>

                                    </div>
                                </div>
                                <p class="mb-0">
                                    {{ $comment->message }}
                                </p>
                            </div>

                        @empty

                            <div class="alert alert-light text-center mb-0">
                                <i class="bi bi-chat-square-text me-2"></i>
                                No hay preguntas todavía.
                            </div>

                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection