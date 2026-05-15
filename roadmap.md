# Roadmap de Desarrollo

Este roadmap contiene todas las tareas necesarias para construir el sistema completo. Está dividido en Backend y Frontend, con prioridades y un orden de implementación lógico.

---

## 1. Prioridad alta / Base del sistema

### 1.1 Backend

1. Definir modelos y migraciones
   - Crear migraciones para `users`, `events`, `participants`, `certificates`, `logs`.
   - Implementar modelos Eloquent: `User`, `Event`, `Participant`, `Certificate`, `Log`.

2. Configurar autenticación y autorización
   - Configurar `auth` de Laravel para administradores.
   - Crear middleware `Authenticate` para proteger rutas admin.
   - Crear primer admin en `DatabaseSeeder`.

3. Crear estructura de rutas y controladores básicos
   - Configurar `project/routes/web.php` con rutas públicas y admin.
   - Crear controlador base `Controller` y controladores iniciales.

4. Implementar gestión de jornadas
   - `Admin/EventController`: crear, editar, listar, publicar y ocultar eventos.
   - Validación usando `StoreEventRequest`.
   - Soporte a estados de evento y fechas de registro.

5. Implementar inscripciones y validación de cupo
   - `Participant` con modalidad `in_person`/`virtual`.
   - `RegisterParticipantRequest` valida cupos, fecha límite y estado del evento.
   - Controlador de inscripciones públicas.

6. Configurar logs de auditoría
   - Implementar modelo `Log` y servicio `LogService`.
   - Registrar acciones clave: creación de evento, inscripción, pago, QR, certificado.

7. Integrar pagos con Mercado Pago
   - `MercadoPagoService` para crear preferencia y procesar respuestas.
   - `PaymentController` para manejar webhooks y actualizar `payment_status`.
   - Registrar `payment_external_id`, `paid_at` y estado.

8. Generar y validar QR
   - `QrService` genera tokens firmados para inscripciones presenciales.
   - `QrCheckinController` valida QR y marca `checkin_confirmed`.

9. Implementar transmisión segura
   - `StreamingAccessService` valida acceso backend.
   - `StreamingController` entrega iframe solo a participantes autorizados.

10. Generar certificados
    - `CertificateService` crea UUID y PDF.
    - `CertificateController` permite descarga/exportación.
    - Validar condiciones: pago aprobado, participación o evaluación.

### 1.2 Frontend

1. Crear vistas de inscripciones y listado de eventos
   - Página pública de eventos disponibles.
   - Detalle de jornada con formulario de inscripción.
   - Historial de jornadas.

2. Implementar panel administrativo inicial
   - Página de listado de jornadas.
   - Formularios de creación y edición de jornadas.
   - Páginas para ver inscriptos y detalles de cada evento.

3. Crear experiencia de pago
   - Integrar Checkout Pro de Mercado Pago en el flujo de inscripción.
   - Mostrar estados pendientes, aprobados y rechazados.

4. Crear página de streaming
   - Página con iframe de YouTube protegida.
   - Mensaje de acceso denegado cuando no autorizado.

5. Añadir navegación y encabezados
   - Menú con `Jornadas`, `Información`, `Inscribirse`.
   - Diseño claro en dispositivos móviles.

6. Añadir notificaciones y correos visuales
   - Mensajes flash de éxito/error.
   - Confirmaciones de inscripción y pago visibles.

---

## 2. Orden cronológico de implementación

### 2.1 Fase 1: Base funcional

#### Backend
- Migraciones y modelos.
- Autenticación/admin.
- Rutas y controladores de eventos.
- Inscripciones y reglas de validación.
- Logs básicos.

#### Frontend
- Vistas públicas de eventos e inscripciones.
- Panel admin inicial y formularios.

### 2.2 Fase 2: Pagos, QR y acceso

#### Backend
- Integración Mercado Pago.
- Lógica transaccional para pagos y cupos.
- Generación de QR y validación de check-in.
- Streaming backend-side.

#### Frontend
- Flujo de pago con Mercado Pago.
- Página de streaming protegida.
- Panel admin para estados de pago y QR.

### 2.3 Fase 3: Certificados, evaluaciones y mejoras

#### Backend
- Servicio de certificados y generación de PDF.
- Evaluaciones posteriores y estado de aprobación.
- Auditoría completa y logs avanzados.

#### Frontend
- Interfaz de certificados y descargas.
- Página de evaluación sencilla.
- Estadísticas administrativas.

### 2.4 Fase 4: Ajustes y calidad

#### Backend
- Revisión de seguridad, validaciones y middleware.
- Pruebas unitarias y funcionales.
- Documentación técnica final.

#### Frontend
- Ajustes de usabilidad móvil.
- Accesibilidad mínima.
- Mensajes de estado y experiencia de usuario.

---

## 3. Tareas por rol

### Backend

- Crear migraciones y modelos de datos.
- Implementar lógica del dominio en modelos y servicios.
- Integrar Mercado Pago y manejar webhooks.
- Generar QR y validar acceso.
- Crear certificados digitales.
- Manejar auditoría y logs.
- Configurar seguridad y middleware.
- Escribir pruebas unitarias y funcionales.

### Frontend

- Diseñar interfaz pública de eventos e inscripciones.
- Implementar panel administrativo usable.
- Crear flujo visual de pago.
- Implementar página de streaming protegida.
- Desarrollar manejo de mensajes e interacciones.
- Ajustar estilos responsivos y accesibilidad.

## 4. Prioridad general

1. Base de datos y modelos.
2. Autenticación y administración.
3. Gestión de eventos y inscripciones.
4. Pagos y validación de cupos.
5. Generación de QR y acceso.
6. Transmisión y protección de streaming.
7. Certificados y evaluaciones.
8. Auditoría y correos automáticos.
9. Frontend completo y experiencia de usuario.
10. Pruebas, accesibilidad y limpieza final.
