@extends('layouts.app', [
    'dashboard' => true
])

@section('admin-dashboard')

<div class="dashboard-wrapper">

    <div class="container">

        <div class="dashboard-header">

            <h1 class="dashboard-title">
                Panel de Administración
            </h1>

            <p class="dashboard-subtitle">
                Bienvenido, <strong>{{ auth()->user()->name }}</strong>
            </p>

        </div>

        <div class="row g-4">

            <div class="col-md-6 col-lg-4">
                <a href="{{ route('admin.events.index') }}" class="dashboard-card text-decoration-none">
                    <div class="card-icon">📅</div>
                    <h3>Jornadas</h3>
                    <p>Gestionar jornadas y transmisiones.</p>
                </a>
            </div>

            <div class="col-md-6 col-lg-4">
                <a href="{{ route('admin.participants.index') }}" class="dashboard-card text-decoration-none">
                    <div class="card-icon">👥</div>
                    <h3>Participantes</h3>
                    <p>Ver inscriptos y asistencia.</p>
                </a>
            </div>

            <div class="col-md-6 col-lg-4">
                <a href="{{ route('admin.users.index') }}" class="dashboard-card text-decoration-none">
                    <div class="card-icon">👤</div>
                    <h3>Usuarios</h3>
                    <p>Administrar usuarios del sistema.</p>
                </a>
            </div>

            <div class="col-md-6 col-lg-4">
                <a href="{{ route('admin.logs.index') }}" class="dashboard-card text-decoration-none">
                    <div class="card-icon">📋</div>
                    <h3>Logs</h3>
                    <p>Historial de actividad.</p>
                </a>
            </div>

            <div class="col-md-6 col-lg-4">
                <a href="{{ route('admin.certificates.index') }}" class="dashboard-card text-decoration-none">
                    <div class="card-icon">🏆</div>
                    <h3>Certificados</h3>
                    <p>Gestionar certificados emitidos.</p>
                </a>
            </div>

        </div>

    </div>

</div>

@endsection