@extends('layouts.app', ['inscripcion' => true])

@section('form')
<section class="form-wrapper">
    <div class="form-box">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Pagina Principal</a>
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
            <h1 class="form-heading mb-0">Logs</h1>

            <a href="{{ route('admin.logs.create') }}" class="btn btn-primary">
                Crear log
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @php
            $items = $log ?? collect();
        @endphp

        @if($items->isNotEmpty())
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">

                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Usuario</th>
                            <th>Evento</th>
                            <th>Acción</th>
                            <th>Actor</th>
                            <th>Tabla afectada</th>
                            <th>Entidad</th>
                            <th>Fecha</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td>{{ $item->id }}</td>

                                <td>
                                    {{ $item->user_id ?? '-' }}
                                </td>

                                <td>
                                    {{ $item->event_id ?? '-' }}
                                </td>

                                <td>
                                    {{ $item->action_type }}
                                </td>

                                <td>
                                    {{ $item->actor_type }}
                                </td>

                                <td>
                                    {{ $item->affected_table }}
                                </td>

                                <td>
                                    {{ $item->entity_id }}
                                </td>

                                <td>
                                    {{ $item->created_at }}
                                </td>

                                <td class="text-end">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.logs.edit', $item->id) }}"
                                           class="btn btn-sm btn-outline-primary">
                                            Editar
                                        </a>

                                        <form action="{{ route('admin.logs.destroy', $item->id) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('¿Eliminar este log?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-sm btn-outline-danger">
                                                Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        @else
            <div class="alert alert-info mb-0">
                No hay logs registrados aún.
            </div>
        @endif

    </div>
</section>
@endsection