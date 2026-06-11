<x-app-layout>
    <h1>Jornadas</h1>

    <a href="{{ route('admin.events.create') }}">+ Nueva jornada</a>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif
    @if (session('error'))
        <p>{{ session('error') }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Estado</th>
                <th>Fecha</th>
                <th>Cupo</th>
                <th>Precio</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($events as $event)
                <tr>
                    <td>{{ $event->title }}</td>
                    <td>{{ $event->status }}</td>
                    <td>{{ $event->event_starts_at->format('d/m/Y H:i') }}</td>
                    <td>{{ $event->max_participants ?? 'Sin límite' }}</td>
                    <td>{{ $event->price == 0 ? 'Gratis' : '$' . number_format($event->price, 2) }}</td>
                    <td>
                        <a href="{{ route('admin.events.show', $event) }}">Ver</a>
                        <a href="{{ route('admin.events.edit', $event) }}">Editar</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No hay jornadas cargadas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</x-app-layout>