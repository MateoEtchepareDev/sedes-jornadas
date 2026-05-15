# Guía de Arquitectura del Sistema de Jornadas

Este documento describe cómo está estructurado el sistema, qué hace cada carpeta y archivo, y cómo se relaciona con los requisitos.

## 1. Visión general

El proyecto es una aplicación Laravel simple con un dominio claro:

- `requirements.md`: especificaciones funcionales y no funcionales.
- `schema.md`: esquema de base de datos y modelo de datos.
- `architecture.md`: esta guía.
- `app/`: aplicación Laravel real.

La arquitectura sigue principios de programación orientada a objetos y código limpio, manteniendo responsabilidad única por clase/archivo.

## 2. Estructura general del proyecto

```text
./
  README.md
  requirements.md
  schema.md
  architecture.md
  app/              # Aplicación Laravel
    artisan
    composer.json
    package.json
    app/
      Http/
        Controllers/
        Middleware/
        Requests/
      Models/
      Providers/
      Services/
    bootstrap/
    config/
    database/
      migrations/
      seeders/
    public/
    resources/
      views/
      js/
      css/
    routes/
      web.php
    storage/
    tests/
      Feature/
      Unit/
```

## 3. Qué hace cada carpeta

### `app/` (raíz de la aplicación Laravel)

Contiene la aplicación backend, rutas, configuración y assets.

### `app/app/Models/`

Modelos que representan tablas y comportamientos del dominio.

- `User.php`: administradores.
- `Event.php`: jornadas.
- `Participant.php`: inscripciones.
- `Certificate.php`: certificados.
- `Log.php`: auditoría.

Cada modelo debe incluir métodos claros para reglas de negocio, por ejemplo:

- `Event::isPublished()`.
- `Participant::canRegister()`.
- `Participant::needsQrToken()`.
- `Certificate::isValid()`.

### `app/app/Http/Controllers/`

Controladores HTTP que reciben peticiones y devuelven respuestas.

- `Admin/EventController.php`: CRUD de jornadas.
- `Admin/ParticipantController.php`: gestión manual de participantes.
- `PaymentController.php`: creación de preferencia, confirmación de pagos.
- `QrCheckinController.php`: escaneo y validación de QR.
- `StreamingController.php`: acceso al streaming y control de visibilidad.
- `CertificateController.php`: emisión y descarga de certificados.

Cada controlador debe delegar la lógica pesada a servicios y usar `FormRequest` para validar datos.

### `app/app/Http/Requests/`

Clases para validación de formularios.

- `StoreEventRequest.php`
- `RegisterParticipantRequest.php`
- `PaymentWebhookRequest.php`
- `QrValidationRequest.php`

Esto mantiene los controladores pequeños y seguros.

### `app/app/Http/Middleware/`

Middleware para políticas transversales.

- `Authenticate.php`: restringe acceso a administradores.
- `VerifyStreamingAccess.php`: protege la URL de streaming.
- `PreventBruteForce.php`: bloqueo de intentos de login.

### `app/app/Services/`

Servicios orientados a casos de uso.

- `MercadoPagoService.php`: integración Checkout Pro.
- `QrService.php`: generación y validación de QR seguros.
- `CertificateService.php`: creación de PDF y UUID de certificado.
- `StreamingAccessService.php`: validación backend para eventos online.
- `EmailService.php`: envío de correos automáticos.

Los servicios contienen lógica transaccional y transacciones de base datos al nivel de aplicación.

### `app/app/Providers/`

Servicios y bindings globales.

- `AppServiceProvider.php`: registro de servicios de dominio.
- `AuthServiceProvider.php`: políticas de acceso.

### `app/routes/web.php`

Define las rutas públicas y de administración.

- Rutas públicas: listado de jornadas, inscripciones, acceso a streaming.
- Rutas admin: gestión de eventos, participantes, pagos, QR, estadísticas.

### `app/database/migrations/`

Migraciones que crean las tablas definidas en `schema.md`.

- `create_users_table.php`
- `create_events_table.php`
- `create_participants_table.php`
- `create_certificates_table.php`
- `create_logs_table.php`

### `app/database/seeders/`

Semillas iniciales.

- `DatabaseSeeder.php`: debe crear el primer administrador.

### `app/resources/views/`

Vistas Blade para frontend.

- `public/`: listado de jornadas, formulario de inscripción, transmisión.
- `admin/`: panel de eventos, inscripciones, pagos, QR, estadísticas.

### `app/public/`

Punto de entrada web (`index.php`) y assets compilados.

### `app/tests/`

Tests automáticos.

- `Feature/`: flujo de inscripción, pago, QR, permisos.
- `Unit/`: validaciones de modelo y servicios.

## 4. Cómo se cumplen los requisitos clave

### Administradores y autenticación

- `User.php` + `auth` de Laravel.
- `routes/web.php` con rutas protegidas.
- `Authenticate.php` para evitar acceso público.
- `database/seeders/DatabaseSeeder.php` para primer admin.

### Jornadas y visibilidad

- `Event.php` gestiona estado, fechas y visibilidad.
- `Admin/EventController.php` crea/modifica eventos.
- `resources/views/` muestra status e historial.

### Inscripción y cupos

- `Participant.php` separa participantes de admins.
- `RegisterParticipantRequest.php` valida cupos y fechas.
- `PaymentController.php` gestiona estado de pago.
- `DB::transaction()` en servicios para evitar inconsistencias.

### Pagos y Mercado Pago

- `MercadoPagoService.php` encapsula la API.
- `PaymentController.php` recibe webhooks.
- `Participant::payment_status` y `payment_external_id` guardan estado.

### QR y acceso

- `QrService.php` genera tokens firmados.
- `QrCheckinController.php` valida y marca `checkin_confirmed`.
- `VerifyStreamingAccess.php` protege el stream.

### Certificados

- `CertificateService.php` genera PDF firmado y UUID.
- `CertificateController.php` descarga certificado.
- `Certificate.php` liga certificado con participante.

### Logs y auditoría

- `Log.php` registra acciones.
- `app/app/Services/LogService.php` guarda eventos de creación, pago, QR, certificados.

### Transmisión en vivo y preguntas

- `StreamingController.php` inserta iframe solo para participantes autorizados.
- `resources/views/public/stream.blade.php` muestra la transmisión.
- `app/app/Services/StreamingAccessService.php` valida la URL en backend.

## 5. Recomendaciones de clean code

- Cada clase tiene una sola responsabilidad.
- Los controladores solo orquestan requests y respuestas.
- La lógica de negocio está en modelos y servicios.
- Se usa `FormRequest` para validar cada formulario.
- No se deja lógica de pagos ni QR en las vistas.
- Los nombres deben ser claros: `EventController`, `QrService`, `ParticipantRepository`.

## 6. Propuesta de archivos nuevos importantes

- `app/app/Services/MercadoPagoService.php`
- `app/app/Services/QrService.php`
- `app/app/Services/CertificateService.php`
- `app/app/Services/LogService.php`
- `app/app/Http/Requests/RegisterParticipantRequest.php`
- `app/app/Http/Middleware/VerifyStreamingAccess.php`
- `app/app/Http/Controllers/Admin/EventController.php`
- `app/app/Http/Controllers/PaymentController.php`
- `app/app/Http/Controllers/QrCheckinController.php`
- `app/app/Http/Controllers/CertificateController.php`

## 7. Resumen visual

- `app/app/Models/` → entidad del dominio.
- `app/app/Http/Controllers/` → controladores HTTP.
- `app/app/Http/Requests/` → validación segura.
- `app/app/Http/Middleware/` → seguridad y acceso.
- `app/app/Services/` → lógica de negocio compleja.
- `app/database/migrations/` → esquema físico.
- `app/resources/views/` → interfaz para usuario.
- `tests/` → garantías automáticas.

Con esta estructura, el sistema queda organizado para que cada requerimiento tenga una ubicación clara y el código sea fácil de entender, mantener y ampliar.

## 8. Mapa visual de carpetas y archivos

`app/` -- núcleo de la aplicación Laravel
    `app/app/Models/` -- modelos de dominio
        `User.php` -- datos y reglas de administradores
        `Event.php` -- datos y reglas de jornadas
        `Participant.php` -- datos y reglas de inscripciones
        `Certificate.php` -- gestión de certificados
        `Log.php` -- auditoría de eventos importantes

    `app/app/Http/Controllers/` -- controladores de peticiones
        `Admin/EventController.php` -- CRUD de jornadas
        `Admin/ParticipantController.php` -- edición manual de inscriptos
        `PaymentController.php` -- creación de pagos y lógica de webhooks
        `QrCheckinController.php` -- validación de QR y check-in
        `StreamingController.php` -- protección de streaming y acceso
        `CertificateController.php` -- emisión y descarga de certificados

    `app/app/Http/Requests/` -- validación de formularios
        `StoreEventRequest.php` -- validación de datos de eventos
        `RegisterParticipantRequest.php` -- validación de inscripción y cupo
        `PaymentWebhookRequest.php` -- validación de notificaciones de pago
        `QrValidationRequest.php` -- validación de lectura de código QR

    `app/app/Http/Middleware/` -- filtros de solicitud
        `Authenticate.php` -- protege paneles privados
        `VerifyStreamingAccess.php` -- controla acceso al stream
        `PreventBruteForce.php` -- limita intentos de login

    `app/app/Services/` -- lógica de negocio reutilizable
        `MercadoPagoService.php` -- API de Mercado Pago
        `QrService.php` -- generación y verificación de QR
        `CertificateService.php` -- generación de certificados digitales
        `StreamingAccessService.php` -- reglas de acceso al stream
        `EmailService.php` -- envío de correos automáticos
        `LogService.php` -- creación de registros de auditoría

    `app/app/Providers/` -- bindings y servicios del contenedor
        `AppServiceProvider.php` -- registro de servicios de dominio
        `AuthServiceProvider.php` -- políticas de autorización

`app/routes/web.php` -- define las rutas públicas y privadas
    - rutas públicas: jornadas, inscripción, streaming
    - rutas admin: eventos, participantes, pagos, QR, estadísticas

`app/database/migrations/` -- creación de tablas del esquema
    `create_users_table.php` -- administradores
    `create_events_table.php` -- jornadas
    `create_participants_table.php` -- inscripciones
    `create_certificates_table.php` -- certificados
    `create_logs_table.php` -- auditoría

`app/database/seeders/` -- datos iniciales
    `DatabaseSeeder.php` -- primer administrador

`app/resources/views/` -- UI del sistema
    `public/` -- vistas de usuario y eventos
    `admin/` -- panel administrativo

`app/tests/` -- verificación automática
    `Feature/` -- flujos completos (registro, pago, QR, permisos)
    `Unit/` -- pruebas de modelos y servicios
