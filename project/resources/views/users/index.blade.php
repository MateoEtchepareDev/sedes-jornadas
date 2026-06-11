@extends('layouts.app', ['inscripcion' => true])

@section('form')
<section class="form-wrapper">
    <div class="form-box">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
            <h1 class="form-heading mb-0">Usuarios</h1>
            <a href="{{ route('users.create') }}" class="btn btn-primary">Crear usuario</a>
        </div>

        @php $items = $users ?? collect(); @endphp
        @if($items->isNotEmpty())
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td>{{ $item->name ?? '-' }}</td>
                                <td>{{ $item->email ?? '-' }}</td>
                                <td>{{ ($item->is_admin ?? false) ? 'Admin' : 'Usuario' }}</td>
                                <td class="text-end">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('users.edit', $item) }}" class="btn btn-sm btn-outline-primary">Editar</a>
                                        <form action="{{ route('users.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar este usuario?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-info mb-0">No hay usuarios registrados aún.</div>
        @endif
    </div>
</section>
@endsection
