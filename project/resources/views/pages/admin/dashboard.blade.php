<?php

// codigo tipo boilerplate hecho con IA
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>

    <h1>Panel Admin</h1>

    <p>Bienvenido {{ auth()->user()->name }}</p>

    <a href="{{ route('admin.events.index') }}">Ver todas las jornadas</a>
    <a href="{{ route('admin.participants.index') }}">Ver participantes</a>
    <a href="{{ route('admin.users.index') }}">Ver usuarios</a>
    <a href="{{ route('admin.logs.index') }}">Ver logs de actividad</a>
    <a href="{{ route('admin.certificates.index') }}">Ver certificados</a>

</body>
</html>