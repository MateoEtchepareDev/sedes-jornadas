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

</body>
</html>