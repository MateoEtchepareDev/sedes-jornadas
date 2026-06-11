@extends('layouts.app', ['edit' => true])

@section('edit')
<div class="form-wrapper">
    <div class="form-box">
        <h1 class="form-heading">Nuevo Usuario</h1>
        @if ($errors->any())
            <div style="color:red">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('users.store') }}">
            @csrf
            <div class="form-grid">
                <div class="field-group"><label class="field-label">Nombre</label><input class="field-input" type="text" name="name" required></div>
                <div class="field-group"><label class="field-label">Email</label><input class="field-input" type="email" name="email" required></div>
                <div class="field-group"><label class="field-label">Contraseña</label><input class="field-input" type="password" name="password_hash" required></div>
                <div class="field-group"><label class="field-label">Confirmar contraseña</label><input class="field-input" type="password" name="password_hash_confirmation" required></div>
                <div class="field-group"><label class="field-label">Administrador</label>
                    <select class="field-select" name="is_admin" required>
                        <option value="0">No</option>
                        <option value="1">Sí</option>
                    </select>
                </div>
            </div>
            <div class="submit-zone d-flex flex-wrap gap-2 mt-3">
                <button type="submit" class="btn btn-primary">Crear Usuario</button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Volver al listado</a>
            </div>
        </form>
    </div>
</div>
@endsection
