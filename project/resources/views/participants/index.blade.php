@extends('layouts.app', [
    'inscripcion' => true
])

@section('form')

<section class="form-wrapper">

    <div class="form-box">

        <h1 class="form-heading">
            Participantes Registrados
        </h1>

        @if(session('success'))

            <div class="success-alert">

                {{ session('success') }}

            </div>

        @endif

        <section class="participants-page">

            <div class="card participants-card shadow-sm border-0">

                <div class="card-header participants-card-header bg-white border-0">

                    <div>

                        <h1 class="h3 mb-1 text-dark">Participantes Registrados</h1>

                        <p class="text-muted mb-0">Listado claro y ordenado de todos los participantes.</p>

                    </div>

                </div>

                <div class="card-body p-0">

                    @if($participant->isEmpty())

                        <div class="empty-state text-center py-5">

                            <p class="mb-0 text-muted">No hay participantes registrados todavía.</p>

                        </div>

                    @else

                        <div class="table-responsive">

                            <table class="table table-hover align-middle participants-table mb-0">

                                <thead class="table-light">

                                    <tr>

                                        <th scope="col">Nombre completo</th>

                                        <th scope="col">Email</th>

                                        <th scope="col">DNI</th>

                                        <th scope="col">Rol</th>

                                        <th scope="col">Modalidad</th>

                                        <th scope="col">Pago</th>

                                        <th scope="col" class="text-end">Acciones</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    @foreach($participant as $item)

                                        <tr>

                                            <td class="fw-semibold">{{ $item->full_name }}</td>

                                            <td>{{ $item->email }}</td>

                                            <td>{{ $item->dni }}</td>

                                            <td>{{ ucfirst($item->role) }}</td>

                                            <td>{{ $item->modality == 'virtual' ? 'Virtual' : 'Presencial' }}</td>

                                            <td>{{ $item->payment_method == 'mercado_pago' ? 'Mercado Pago' : 'Efectivo' }}</td>

                                            <td class="text-end">

                                                <a href="{{ route('participants.edit', $item->id) }}" class="btn btn-outline-primary btn-sm">

                                                    Editar

                                                </a>

                                            </td>

                                        </tr>

                                    @endforeach

                                </tbody>

                            </table>

                        </div>

                    @endif

                </div>

            </div>

        </section>

    </div>

</section>

@endsection