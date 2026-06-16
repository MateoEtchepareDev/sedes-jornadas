<h1>Preguntas de los participantes</h1>

@forelse($comments as $comment)
    <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
        <p>{{ $comment->message }}</p>
        <small>{{ $comment->created_at }}</small>
    </div>
@empty
    <p>No hay preguntas todavía.</p>
@endforelse

<script>
    setTimeout(function () {
        location.reload();
    }, 15000);
</script>