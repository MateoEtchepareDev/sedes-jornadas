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

        $cronogramas = [
            [
                'hora' => '09:00',
                'titulo' => 'Acreditación',
                'descripcion' => 'Ingreso y presentación de participantes.'
            ],
            [
                'hora' => '10:00',
                'titulo' => 'Conferencia Principal',
                'descripcion' => 'El impacto de la IA en educación.'
            ],
            [
                'hora' => '12:00',
                'titulo' => 'Mesa de Debate',
                'descripcion' => 'Docentes y especialistas invitados.'
            ],
        ];
        
        $jornadasAnteriores = [
            [
                'titulo' => '1° Jornada',
                'descripcion' => 'Desafíos y oportunidades en la era digital.',
                'url' => 'https://google.com'
            ],
            [
                'titulo' => '2° Jornada',
                'descripcion' => 'Tecnologías emergentes en educación.',
                'url' => 'https://google.com'
            ],
            [
                'titulo' => '3° Jornada',
                'descripcion' => 'Transformación digital educativa.',
                'url' => 'https://google.com'
            ],
                        [
                'titulo' => '4° Jornada',
                'descripcion' => 'Desafíos y oportunidades en la era digital.',
                'url' => 'https://google.com'
            ],
            [
                'titulo' => '5° Jornada',
                'descripcion' => 'Tecnologías emergentes en educación.',
                'url' => 'https://google.com'
            ],
            [
                'titulo' => '6° Jornada',
                'descripcion' => 'Transformación digital educativa.',
                'url' => 'https://google.com'
            ],
                        [
                'titulo' => '7° Jornada',
                'descripcion' => 'Desafíos y oportunidades en la era digital.',
                'url' => 'https://google.com'
            ],
            [
                'titulo' => '8° Jornada',
                'descripcion' => 'Tecnologías emergentes en educación.',
                'url' => 'https://google.com'
            ],
            [
                'titulo' => '9° Jornada',
                'descripcion' => 'Transformación digital educativa.',
                'url' => 'https://google.com'
            ],
        ];

        return view('pages.home', compact(
            'jornada',
            'cronogramas',
            'jornadasAnteriores'
        ));
    }
}
