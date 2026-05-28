<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $jornada = [
            'titulo' => '10° Jornada',
            'subtitulo' => 'El aula en tiempo de algoritmos, pantalla e inmediatez',
            'fecha' => '15 de Junio, 2026',
            'hora' => '10:00 hs',
            'modalidad' => 'Virtual y Presencial',
            'lugar' => 'Instituto Sedes Sapientiae',
            'precio' => '$15.000',
            'imagen' => 'images/imagen.png',
            'flyer' => 'images/flyer.jpeg'
        ];
        
        $jornadasAnteriores = [
            [
                'titulo' => '1° Jornada',
                'descripcion' => 'Enseñar y aprender en la Sociedad de la Información y del Conocimiento.',
                'url' => 'https://www.sedessapientiae.edu.ar/jornadas/jornadas.htm'
            ],
            [
                'titulo' => '2° Jornada',
                'descripcion' => 'Pensando la docencia en clave de diseño.',
                'url' => 'https://www.sedessapientiae.edu.ar/jornadas-18/jornadas2018-sedes3.htm'
            ],
            [
                'titulo' => '3° Jornada',
                'descripcion' => 'La lectura y la escritura como clave transversal para todo aprendizaje.',
                'url' => 'https://www.sedessapientiae.edu.ar/jornadas-19/jornadas2019.html'
            ],
                        [
                'titulo' => '4° Jornada',
                'descripcion' => 'De prácticas y mediaciones en la virtualidad repentina.',
                'url' => 'https://www.sedessapientiae.edu.ar/jornada-IV/jornada-iv.html'
            ],
            [
                'titulo' => '5° Jornada',
                'descripcion' => 'El arte docente en tiempos de incertidumbre.',
                'url' => 'https://www.sedessapientiae.edu.ar/jornada-V/index.htm'
            ],
            [
                'titulo' => '6° Jornada',
                'descripcion' => 'Aulas Inclusivas: hacia la diversificacion curricular y la identificacion de barreras para el aprendizaje.',
                'url' => 'https://www.sedessapientiae.edu.ar/jornada-VI/index.htm'
            ],
                        [
                'titulo' => '7° Jornada',
                'descripcion' => 'Educación emocional como eje transversal del proceso educativo.',
                'url' => 'https://www.sedessapientiae.edu.ar/jornada-VII/index.htm'
            ],
            [
                'titulo' => '8° Jornada',
                'descripcion' => 'Desafios y oportunidades en la era de la inteligencia artificial generativa ¿Estamos preparados para esta revolución educativa?.',
                'url' => 'https://www.sedessapientiae.edu.ar/jornada-VIII/index.htm'
            ],
            [
                'titulo' => '9° Jornada',
                'descripcion' => 'Convivir para aprender: claves para construir entornos escolares seguros; prevencion y tratamiento de la violencia escolar.',
                'url' => 'https://www.sedessapientiae.edu.ar/jornada-IX/index.htm'
            ],
        ];

        return view('pages.public.home', compact(
            'jornada',
            'jornadasAnteriores'
        ));
    }
}
