@extends('layouts.app', ['edit' => true])

@section('edit')
<div class="form-wrapper">
    <div class="form-box">
        <h1 class="form-heading">Nuevo Certificado</h1>
        @if ($errors->any())
            <div style="color:red">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('certificates.store') }}">
            @csrf
            <div class="form-grid">
                <div class="field-group"><label class="field-label">Participante</label><input class="field-input" type="number" name="participant_id" required></div>
                <div class="field-group"><label class="field-label">Evento</label><input class="field-input" type="number" name="event_id" required></div>
                <div class="field-group"><label class="field-label">URL del Certificado</label><input class="field-input" type="text" name="certificate_url" required></div>
                <div class="field-group"><label class="field-label">Fecha de emisión</label><input class="field-input" type="date" name="issued_at" required></div>
            </div>
            <div class="submit-zone d-flex flex-wrap gap-2 mt-3">
                <button type="submit" class="btn btn-primary">Crear Certificado</button>
                <a href="{{ route('certificates.index') }}" class="btn btn-secondary">Volver al listado</a>
            </div>
        </form>
    </div>
</div>
@endsection
