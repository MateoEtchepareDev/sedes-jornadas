@extends('layouts.app')

@section('content')

<section class="hero-section">

    <div class="container custom-container">
        <div class="hero-card">
            <div class="container-custom row align-items-center g-5">
                <div class="col-12 col-lg-4">
                    <h1 class="hero-title"> {{ $jornada['titulo'] }} </h1>
                    <p class="hero-subtitle"> {{ $jornada['subtitulo'] }} </p>

                    <div class="hero-info-box">
                        <ul>
                            <li><strong>Fecha: </strong>{{ $jornada['fecha'] }}</li>
                            <li><strong>Horario: </strong>{{ $jornada['hora'] }}</li>
                            <li><strong>Modalidad: </strong>{{ $jornada['modalidad'] }}</li>
                            <li><strong>Lugar: </strong>{{ $jornada['lugar'] }}</li>
                            <li><strong>Precio: </strong>{{ $jornada['precio'] }}</li>
                        </ul>
                    </div>

                    <div class="hero-buttons col-12">
                        <a href="/inscripcion" class="btn-yellow" > Inscribirse </a>
                        <a href="#sobre" class="btn-blue"> Ver Información </a>
                    </div>

                </div>

                <div class="col-12 col-lg-8">
                    <img src="{{ asset($jornada['flyer2']) }}" alt="jornada" class="hero-image">
                </div>

            </div>
        </div>
    </div>
</section>

<section id="sobre" class="section-custom section-white">
    <div class="container custom-container sobre-container">
        <div class="sobre-card">
            <h2 class="section-title">
                Sobre la jornada
            </h2>

            <div class="row g-4 align-items-stretch">

                <div class="col-12 col-lg-5">

                    <p class="sobre-text">
                        La X Jornada de Innovación y Práctica Docente invita a docentes,
                        directivos, estudiantes y profesionales de la educación a reflexionar
                        sobre los desafíos que plantea la cultura digital en los procesos de
                        enseñanza y aprendizaje. En esta edición, bajo el lema
                        "El aula en tiempos de algoritmos, pantallas e inmediatez",
                        se propone un espacio de diálogo, análisis e intercambio de experiencias
                        para comprender y resignificar las prácticas educativas contemporáneas.
                    </p>

                    <div class="info-mini-box">

                        <h3>
                            Objetivo
                        </h3>

                        <p>
                            Generar un espacio de reflexión y formación que permita analizar el
                            impacto de las tecnologías digitales, los algoritmos y las nuevas formas
                            de comunicación en los procesos educativos, promoviendo prácticas
                            pedagógicas críticas, inclusivas y significativas.
                        </p>

                    </div>

                    <div class="info-mini-box">

                        <h3>
                            Propósito
                        </h3>

                        <p>
                            Favorecer el intercambio de conocimientos y experiencias entre docentes
                            y especialistas, impulsando nuevas perspectivas para habitar y
                            resignificar la enseñanza en un contexto atravesado por la inmediatez,
                            las pantallas y las transformaciones culturales producidas por la era digital.
                        </p>

                    </div>

                </div>

                <div class="col-12 col-lg-7">

                    <img
                        src="{{ asset($jornada['flyer']) }}"
                        alt="flyer"
                        class="flyer-image flyer-small">
                </div>

            </div>

            <div class="contenido-box">

                <h3>Contenido de la Jornada</h3>

                <p>
                Durante la jornada se abordarán temáticas vinculadas con la educación y
                la cultura digital, entre ellas:
                </p>

                <ul>
                    <li>El aula en tiempos de algoritmos, pantallas e inmediatez.</li>
                    <li>Las formas contemporáneas de consumo y expresión digital.</li>
                    <li>El uso crítico y significativo de las tecnologías en educación.</li>
                    <li>La participación estudiantil en la cultura digital.</li>
                    <li>La enseñanza y el aprendizaje en contextos de transformación tecnológica.</li>
                    <li>Los desafíos pedagógicos frente a la dispersión y la dependencia digital.</li>
                    <li>Nuevas formas de pensar, crear y producir conocimiento.</li>
                </ul>

            </div>

        </div>

    </div>

</section>

<section
    id="anteriores"
    class="section-custom">

    <div class="container custom-container">

        <h2 class="section-title">
            Jornadas Anteriores
        </h2>

        <div class="row g-3">

            @foreach($jornadasAnteriores as $item)

                <div class="col-12 col-sm-6 col-lg-4">

                    @include('components.jornada-card', [
                        'titulo' => $item['titulo'],
                        'descripcion' => $item['descripcion'],
                        'url' => $item['url']
                    ])

                </div>

            @endforeach

        </div>

    </div>

</section>

@endsection