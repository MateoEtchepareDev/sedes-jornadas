<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ParticipantsController;
use App\Http\Controllers\MercadoPagoController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\LogsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\StreamingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController;
use App\Models\Event;



Route::get('/inscripcion', function () {
    return view('pages.public.inscription');
});
Route::get('/admin/comments', [CommentController::class, 'adminTransmission'])
    ->name('pages.admin.comments');

Route::post('/comments', [CommentController::class, 'store']);

Route::get('/comments', [CommentController::class, 'adminTransmission'])->name('pages.admin.comments');

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/code', function () {
    return view('pages.public.code');
});


Route::post('/code', [StreamingController::class, 'validateCode'])
    ->name('code.validate');



Route::view('/inscripcion', 'pages.public.inscription')
    ->name('pages.public.inscription');


Route::post('/participantCrud', [ParticipantsController::class, 'storeCrud'])
    ->name('participants.storeCrud');

Route::post('/participants', [ParticipantsController::class, 'storeFormulario'])
    ->name('participants.storeFormulario');

Route::get('/cash/success', function () {
    return view('cash.success');
    })->name('cash.success');



// no se si esta ruta va en esta categoria
Route::get('/transmission', function () {

   if (!session ('stream_access')){    //si no tiene acceso lo manda nuevamente al codigo
        return redirect('/code');
    }

    $event = Event::where('status', 'active')->first();

    if (!$event) {

        session()->flush();

        return redirect('/code')
            ->with('error', 'No hay ninguna transmisión activa.');
    }

    $comments = \App\Models\Comment::latest()->get();

    return view('pages.public.transmission', compact('event', 'comments'));
})->name('transmission');

/*RUTAS MERCADO PAGO*/

Route::post('/create-preference', [MercadoPagoController::class, 'createPaymentPreference']);
Route::get('/mercadopago/success', [MercadoPagoController::class, 'success'])->name('mercadopago.success');
Route::get('/mercadopago/failed', [MercadoPagoController::class, 'failed'])->name('mercadopago.failed');
Route::get('/mercadopago/pending', [MercadoPagoController::class, 'pending'])->name('mercadopago.pending');
Route::post('/webhook/mercadopago', [\App\Http\Controllers\WebhookController::class, 'handleMercadoPagoWebhook'])->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\PreventRequestForgery::class);


/*
|--------------------------------------------------------------------------
| Public Features (Planned)
|--------------------------------------------------------------------------
|
| TODO:
| - Payment checkout page
| - Public events listing
| - Event details page
| - Event registration flow
| - Streaming access
| - Certificate validation
|
| Future routes:
|
| GET  /pagar
| GET  /eventos
| GET  /eventos/{event}
| GET  /eventos/{event}/inscribirse
| POST /eventos/{event}/inscribirse
| GET  /eventos/{event}/streaming
| GET  /certificados/{uuid}
|
*/

/*
|--------------------------------------------------------------------------
| Admin authentication
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->group(function () {

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('/login', [AuthenticatedSessionController::class, 'store'])
        ->name('admin.login');
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');


// Página de solicitud de restablecimiento de contraseña: solicita email para enviar enlace.
// Acción de envío de correo de restablecimiento: genera token y envía el email.
// Página de restablecimiento de contraseña: permite ingresar nueva contraseña con token.
// Acción de actualización de contraseña: guarda la nueva contraseña y autentica al admin.

/*
|--------------------------------------------------------------------------
| Authentication Features (Planned)
|--------------------------------------------------------------------------
|
| TODO:
| - Forgot password
| - Password reset email
| - Password reset form
|
| Future routes:
|
| GET  /forgot-password
| POST /forgot-password
| GET  /reset-password/{token}
| POST /reset-password
|
*/


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        /*
        |--------------------------------------------------------------------------
        | Resource Management
        |--------------------------------------------------------------------------
        */

        Route::resource('events', EventsController::class);

        Route::resource('participants', ParticipantsController::class);

        Route::resource('users', UsersController::class);

        Route::resource('logs', LogsController::class);
        
        Route::resource('certificate', CertificateController::class);

        /*
        |--------------------------------------------------------------------------
        | Event Management (Planned)
        |--------------------------------------------------------------------------
        |
        | TODO:
        | - Publish event
        | - Hide event
        | - Cancel event
        |
        */

        // Route::post('/events/{event}/publish');
        // Route::post('/events/{event}/hide');
        // Route::post('/events/{event}/cancel');

        /*
        |--------------------------------------------------------------------------
        | Participant Management (Planned)
        |--------------------------------------------------------------------------
        |
        | TODO:
        | - Approve registration
        | - Reject registration
        | - Manual check-in
        |
        */

        // Route::post('/participants/{participant}/approve');
        // Route::post('/participants/{participant}/reject');

        /*
        |--------------------------------------------------------------------------
        | QR Check-In (Planned)
        |--------------------------------------------------------------------------
        |
        | TODO:
        | - QR scanner page
        | - Check-in endpoint
        |
        */

        // Route::get('/checkin');
        // Route::post('/checkin');

        /*
        |--------------------------------------------------------------------------
        | Admin Management (Planned)
        |--------------------------------------------------------------------------
        |
        | TODO:
        | - Create admin
        | - Edit admin
        | - Disable admin
        |
        */
    });



//--------certificates------------------

Route::get('/certificates/{uuid}', [CertificateController::class, 'show'])
    ->name('certificates.show');

//--------------------------------------
