@extends('layouts.app', ['edit' => true])

@section('edit')
<div class="form-wrapper">
    <div class="form-box">
        <h1 class="form-heading">Editar Certificado</h1>
        <form method="POST" action="{{ route('certificates.update', $certificate->id ?? 1) }}">
            @csrf
            @method('PUT')
            <div class="form-grid">
                <div class="field-group"><label class="field-label">Participante</label><input class="field-input" type="number" name="participant_id" value="{{ $certificate->participant_id ?? '' }}" required></div>
                <div class="field-group"><label class="field-label">Evento</label><input class="field-input" type="number" name="event_id" value="{{ $certificate->event_id ?? '' }}" required></div>
                <div class="field-group"><label class="field-label">URL del Certificado</label><input class="field-input" type="text" name="certificate_url" value="{{ $certificate->certificate_url ?? '' }}" required></div>
                <div class="field-group"><label class="field-label">Fecha de emisión</label><input class="field-input" type="date" name="issued_at" value="{{ $certificate->issued_at ?? '' }}" required></div>
            </div>
            <div class="submit-zone d-flex flex-wrap gap-2 mt-3">
                <button type="submit" class="btn btn-primary">Actualizar Certificado</button>
                <a href="{{ route('certificates.index') }}" class="btn btn-secondary">Volver al listado</a>
            </div>
        </form>
    </div>
</div>
@endsection
