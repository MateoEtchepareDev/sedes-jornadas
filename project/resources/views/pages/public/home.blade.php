@extends('layouts.app')

@section('content')

<section class="hero-section">

    <div class="container custom-container">

        <div class="hero-card">

            <div class="row align-items-center g-5">

                <div class="col-12 col-lg-6">

                    <h1 class="hero-title">
                        {{ $jornada['titulo'] }}
                    </h1>

                    <p class="hero-subtitle">
                        {{ $jornada['subtitulo'] }}
                    </p>

                    <div class="hero-info-box">

                        <ul>

                            <li>
                                Fecha: {{ $jornada['fecha'] }}
                            </li>

                            <li>
                                Horario: {{ $jornada['hora'] }}
                            </li>

                            <li>
                                Modalidad: {{ $jornada['modalidad'] }}
                            </li>

                            <li>
                                Lugar: {{ $jornada['lugar'] }}
                            </li>

                            <li>
                                Arancel de la jornada: {{ $jornada['precio'] }}
                            </li>
                        </ul>

                    </div>

                    <div class="hero-buttons col-8">

                        <a
                            href="/inscripcion"
                            class="btn-yellow" >

                            Inscribirse

                        </a>

                        <a
                            href="#sobre"
                            class="btn-blue">

                            Ver Información

                        </a>

                    </div>

                </div>

                <div class="col-12 col-lg-6">

                    <img
                        src="{{ asset($jornada['flyer']) }}"
                        alt="jornada"
                        class="hero-image">
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

                        Lorem ipsum is simply dummy text of the printing and
                        typesetting industry.

                    </p>

                    <div class="info-mini-box">

                        <h3>
                            Objetivo
                        </h3>

                        <p>
                            Lorem ipsum is simply dummy text.
                        </p>

                    </div>

                    <div class="info-mini-box">

                        <h3>
                            Propósito
                        </h3>

                        <p>
                            Lorem ipsum is simply dummy text.
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

                <h3>
                    Contenido de la Jornada
                </h3>

                <p>
                    Lorem ipsum is simply dummy text of the printing industry.
                </p>

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