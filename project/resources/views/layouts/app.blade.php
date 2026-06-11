<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta
    name="viewport"
    content="width=device-width, initial-scale=1.0">
    <title>Jornadas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <link rel="stylesheet" href="{{ asset('css/inscription.css') }}">

    <link rel="stylesheet" href="{{ asset('css/code.css') }}">

    <link rel="stylesheet" href="{{ asset('css/edit.css') }}">

    <link rel="stylesheet" href="{{ asset('css/payment.css') }}">

</head>

<body>

    @include('components.navbar')

    <main>

        @if(!empty($inscripcion))

                @yield('form')

            @elseif(!empty($code))

                @yield('input-code')
            
            @elseif(!empty($edit))

                @yield('edit')

            @else

                @yield('content')

        @endif

    </main>

    @include('components.footer')

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js">
    </script>

</body>

</html>