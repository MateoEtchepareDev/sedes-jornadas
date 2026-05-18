<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;

Route::get('/', [HomeController::class, 'index']);

// Página de listado de eventos: muestra eventos publicados y permite filtrar por estado/fecha.
Route::get('/eventos', [EventController::class, 'index'])->name('eventos.index');

// Página de detalle del evento: muestra información del evento, fechas, cupo y botón de inscripción.
Route::get('/eventos/{event}', [Controller::class, 'method']);

// Página de inscripción al evento: muestra formulario para ingresar datos de participante y elegir modalidad.
Route::get('/eventos/{event}/inscribirse', [Controller::class, 'method']);

// Acción de envío de inscripción: valida cupos, fecha límite y crea inscripción pendiente de pago.
Route::post('/eventos/{event}/inscribirse', [Controller::class, 'method']);

// Página de streaming del evento: muestra iframe de transmisión solo para participantes autorizados.
Route::get('/eventos/{event}/streaming', [Controller::class, 'method']);

// Página de certificado: permite ver/validar el certificado usando su UUID.
Route::get('/eventos/{event}/certificados/{uuid}', function () {

});

// Página de login: muestra formulario de acceso para administradores.
Route::get('/admin/login',);

// Acción de login: autentica administrador y redirige al panel.
Route::post('/admin/login',);

// Acción de logout: cierra sesión del administrador.
Route::post('/admin/logout', function () {

});

// Página de solicitud de restablecimiento de contraseña: solicita email para enviar enlace.
Route::get('/admin/restablecer');

// Acción de envío de correo de restablecimiento: genera token y envía el email.
Route::post('/admin/restablecer', function () {

});

// Página de restablecimiento de contraseña: permite ingresar nueva contraseña con token.
Route::get('/admin/restablecer-nueva', function () {

});

// Acción de actualización de contraseña: guarda la nueva contraseña y autentica al admin.
Route::post('/admin/restablecer-nueva', function () {

});

// Panel admin: muestra resumen y accesos rápidos de jornadas e inscripciones.
Route::get('/admin/panel', [Controller::class, 'method']);

// Página de listado de jornadas admin: lista jornadas con acciones de editar, publicar/ocultar y eliminar.
Route::get('/admin/panel/jornadas', function() {

});

// Página de creación de jornada admin: muestra formulario para crear evento.
Route::get('/admin/panel/jornadas/nueva', function () {

});

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