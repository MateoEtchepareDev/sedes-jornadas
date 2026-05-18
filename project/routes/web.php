<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/inscripcion', function () {
    return view('pages.public.inscription');
});

Route::get('/code', function () {
    return view('pages.public.code');
});