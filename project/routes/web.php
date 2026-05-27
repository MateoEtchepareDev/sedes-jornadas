<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ParticipantsController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/inscripcion', function () {
    return view('pages.public.inscription');
});

Route::get('/code', function () {
    return view('pages.public.code');
});

//te redirige a la pagina para hacer el pago
Route::get('/pagar', [PaymentController::class, 'checkout']);

/* Route::get('/', function () {
    return view('welcome');
});
//=======
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/inscription', function() {
    return view('pages.inscription');
})->name('inscription'); */

Route::resource('participants', ParticipantsController::class);

// Página de listado de eventos: muestra eventos publicados y permite filtrar por estado/fecha.
Route::get('/eventos', [App\Http\Controllers\EventController::class, 'index'])->name('eventos.index');

// Página de detalle del evento: muestra información del evento, fechas, cupo y botón de inscripción.
Route::get('/eventos/{event}', [Controller::class, 'method']);

// Página de inscripción al evento: muestra formulario para ingresar datos de participante y elegir modalidad.
Route::get('/eventos/{event}/inscribirse', [Controller::class, 'method']);

// Acción de envío de inscripción: valida cupos, fecha límite y crea inscripción pendiente de pago.
Route::post('/eventos/{event}/inscribirse', [Controller::class, 'method']);

// Página de streaming del evento: muestra iframe de transmisión solo para participantes autorizados.
Route::get('/eventos/{event}/streaming', [Controller::class, 'method']);

// Página de certificado: permite ver/validar el certificado usando su UUID.
Route::get('/eventos/{event}/certificados/uuid',);

// Página de login: muestra formulario de acceso para administradores.
Route::get('/admin/login',);

// Acción de login: autentica administrador y redirige al panel.
Route::post('/admin/login',);


// Acción de logout: cierra sesión del administrador.
// Página de solicitud de restablecimiento de contraseña: solicita email para enviar enlace.
// Acción de envío de correo de restablecimiento: genera token y envía el email.
// Página de restablecimiento de contraseña: permite ingresar nueva contraseña con token.
// Acción de actualización de contraseña: guarda la nueva contraseña y autentica al admin.

// Panel admin: muestra resumen y accesos rápidos de jornadas e inscripciones.
// Página de listado de jornadas admin: lista jornadas con acciones de editar, publicar/ocultar y eliminar.
// Página de creación de jornada admin: muestra formulario para crear evento.
// Acción de guardar jornada admin: valida datos y crea el evento.
// Página de edición de jornada admin: muestra formulario con datos existentes.
// Acción de actualizar jornada admin: valida cambios y guarda el evento.
// Acción de eliminar jornada admin: borra o marca como cancelada el evento.
// Acción de publicar/ocultar jornada admin: cambia visibilidad del evento.
// Página de participantes por evento admin: lista inscriptos y su estado de pago.
// Página de participante admin: muestra detalles de una inscripción específica.
// Acción de aprobar participante admin: cambia estado de pago o inscripción según lógica.
// Página de QR check-in admin: muestra formulario o escáner para validar entradas.
// Acción de registrar check-in admin: valida QR y marca el ingreso.
// Página de gestión de administradores: lista usuarios admin y permite crear nuevos.
// Página de creación de administrador: muestra formulario de nuevo admin.
// Acción de guardar administrador: valida datos y crea el usuario.
// Página de edición de administrador: muestra formulario para actualizar datos.
// Acción de actualizar administrador: guarda cambios del usuario.
// Acción de eliminar administrador: borra o desactiva al administrador.
//>>>>>>> Stashed changes
