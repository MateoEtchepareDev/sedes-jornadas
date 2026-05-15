# Especificación inicial de requisitos funcionales y no funcionales

A continuación se presenta una especificación inicial de requisitos funcionales y no funcionales para el sistema de gestión de jornadas/eventos con inscripción, pagos, acceso mediante QR, transmisión en vivo y administración centralizada.

La redacción está orientada a documentación de análisis funcional y diseño de software.

## 1. Descripción General del Sistema

El sistema permitirá administrar jornadas/eventos académicos o institucionales, incluyendo:

- Gestión de administradores.
- Gestión de jornadas.
- Inscripciones y pagos online.
- Validación de acceso mediante QR.
- Visualización de transmisiones en vivo.
- Evaluacion simple posteriores al evento.
- Emisión y gestión de certificados.
- Estadísticas y auditoría mediante logs.

El sistema contará con:

- Panel administrativo.
- Integración con Checkout Pro de Mercado Pago.
- Integración con streaming de YouTube.

## 2. Requisitos Funcionales

### RF-01 — Gestión de Administradores

El sistema deberá permitir usuarios administradores, sin un sistema de registro publico. El primer administrador estará ingresado vía BDD y accederá a una página para registrar a más administradores.

**Datos requeridos para administradores**

- Nombre y apellido.
- Correo electrónico.
- Contraseña.
- Documento o identificador único.

### RF-02 — Autenticación

El sistema deberá permitir:

- Inicio de sesión.
- Recuperación de contraseña mediante correo electrónico.

### RF-03 — Gestión de Roles

El sistema deberá:

- Permitir que únicamente administradores creen nuevos administradores.
- El primer administrador será creado manualmente desde base de datos.

### RF-04 — Gestión de Jornadas

El administrador podrá:

- Crear jornadas/eventos.
- Modificar jornadas existentes.
- Modificar visibilidad pública de jornadas.

**Datos configurables de una jornada**

- Nombre.
- Descripción.
- Fecha y horario.
- Cupo máximo.
- Fecha límite de inscripción.
- Estado del evento.
- URL de transmisión en vivo.
- Configuración de preguntas de cuestionario.

### RF-05 — Visualización de Jornadas

Los usuarios podrán:

- Consultar historial de jornadas pasadas.
- Ver información básica de cada jornada.

### RF-06 — Inscripción a Jornadas

El sistema deberá permitir a visitantes del sitio:

- Inscribirse a jornadas disponibles.

El sistema deberá validar:

- Cupos disponibles.
- Fecha límite de inscripción.
- Estado de pago cuando corresponda.

### RF-07 — Gestión de Participantes

El sistema deberá almacenar datos de inscriptos a las jornadas. Es una tabla aparte de users, users está reservada para administradores. Una vez que el usuario pague, se le enviará un PDF con la entrada al email

**Datos de participación**

- Nombre completo
- DNI
- Email
- Jornada asociada.
- Estado de aprobación para certificado.
- Modalidad de participación.
- Estado de pago.
- Estado de lectura QR.
- Fecha de inscripción.

### RF-08 — Integración de Pagos

El sistema deberá integrarse con Checkout Pro de Mercado Pago.

**Funcionalidades**

- Generar preferencia de pago.
- Registrar pagos exitosos.
- Registrar pagos pendientes.
- Registrar pagos rechazados.
- Registrar pagos reembolsados.
- Registrar pagos cancelados.
- Actualizar automáticamente el estado de inscripción.

### RF-09 — Validación de Concurrencia en Pagos

El sistema deberá evitar inconsistencias cuando:

- Dos administradores actualicen participantes simultáneamente.
- Un usuario pague mientras un administrador modifica la jornada.

El sistema deberá:

- Aplicar validaciones transaccionales.
- Mantener integridad de cupos.
- Evitar inconsistencias de inscripción.

**Observaciones:**

- El cupo será ocupado únicamente cuando el pago se encuentre aprobado.
- Puede existir sobreinscripción en casos de concurrencia de pagos simultáneos.

### RF-10 — Generación de QR

El sistema deberá generar un código QR único por inscripción válida.

El QR deberá:

- Identificar al usuario.
- Identificar la jornada.
- Tener validez únicamente para la jornada correspondiente.

Luego el backend:

- Valida estado de pago.

### RF-11 — Escaneo de QR

El sistema deberá permitir al administrador:

- Escanear códigos QR desde una interfaz web.
- Validar autenticidad del QR.
- Registrar ingreso del participante.

**Resultado esperado**

- Marcar “lectura_qr = true”.
- Registrar evento en logs.

### RF-12 — Auditoría y Logs

El sistema deberá registrar eventos relevantes.

**Eventos mínimos**

- Creación/modificación/eliminación de jornadas.
- Inscripciones.
- Cancelaciones.
- Pagos.
- Lectura de QR.
- Emisión de certificados.
- Cambios administrativos.

**Datos del log**

- Usuario responsable.
- Acción realizada y dato modificado.
- Fecha y hora.
- Entidad afectada.

### RF-13 — Streaming en Vivo

El sistema deberá permitir visualizar una transmisión en vivo mediante integración con YouTube.

**Características**

- Inserción mediante iframe.
- Acceso habilitado únicamente para participantes autorizados desde el sistema.

**Observaciones:**

- Se acepta como limitación funcional que la URL directa de YouTube pueda compartirse externamente.

### RF-14 — Caja de Preguntas

Durante la transmisión en vivo, el sistema deberá:

- Permitir el envío informal de preguntas por parte de espectadores.
- Permitir la recepción de preguntas por parte de administradores mediante mecanismos externos.

**Observaciones:**

- No se requiere persistencia en base de datos.
- La implementación podrá realizarse mediante correo electrónico o servicios externos de mensajería.

### RF-15 — Evaluaciones Posteriores

El sistema deberá permitir:

- Completar cuestionarios posteriores al evento.
- Registrar finalización del cuestionario.
- Asociar aprobación automáticamente al participante una vez finalizado el cuestionario.

### RF-16 — Certificados

El sistema deberá generar certificados digitales para participantes aprobados.

**Condiciones configurables**

- Pago confirmado.
- Participación validada.
- Evaluación completada.

**Datos del certificado**

- Nombre del usuario.
- Nombre de la jornada.
- Fecha.
- Código único de validación.

**Observación:**

- El sistema deberá impedir la emisión de certificados a participantes que no cumplan las condiciones configuradas para la jornada.

### RF-19 — Encabezados

El sistema deberá mostrar distintas opciones de navegación:

- Jornadas.
- Información.
- Inscribirse.

### RF-20 — Estadísticas Administrativas

El sistema deberá mostrar estadísticas por jornada.

**Métricas mínimas**

- Total de inscriptos.
- Porcentaje de cuestionarios completados.
- Total de certificados emitidos.
- Distribución por modalidad.

### RF-21 — Gestión Manual de Participantes

El administrador podrá:

- Modificar datos manualmente (agregar inscriptos, modificar estado de pago, etc).

- Toda modificación deberá registrarse en logs.

### RF-22 — Correos Automáticos

El sistema deberá enviar correos automáticos.

**Eventos mínimos**

- Confirmación de inscripción.
- Confirmación de pago.
- Recordatorio previo al evento.
- Disponibilidad de certificados.

### RF-23 — Historial de Eventos

El sistema deberá conservar histórico de jornadas finalizadas.

Cada jornada histórica deberá mostrar:

- Información general.
- Estadísticas.
- Cantidad de participantes.
- Certificados emitidos.

### RF-24 — Envío de acceso

El sistema debe enviar a participantes presenciales por email entrada en PDF con QR y datos del inscripto.

El sistema debe enviar a participantes online, unos minutos antes del evento, un código y una URL. El código será utilizado para ingresar dentro de dicha URL y visualizar la transmisión en vivo.

## 3. Requisitos No Funcionales

### RNF-01 — Seguridad

El sistema deberá:

- Almacenar contraseñas cifradas mediante hashing seguro.
- Utilizar HTTPS.
- Validar autenticación y autorización en cada endpoint.
- Proteger contra SQL Injection, XSS y CSRF.

### RNF-02 — Integridad Transaccional

Las operaciones críticas deberán ejecutarse mediante transacciones atómicas.

**Casos críticos**

- Confirmación de pago.
- Asignación de cupos.
- Registro de ingreso QR.
- Generación de certificados.

### RNF-03 — Disponibilidad

El sistema deberá estar disponible durante el evento con alta tolerancia a fallos.

### RNF-04 — Escalabilidad

La arquitectura deberá separar frontend, backend y servicios externos.

### RNF-05 — Rendimiento //REVISAR

El sistema deberá:

- Responder solicitudes comunes en menos de 3 segundos.
- Soportar accesos concurrentes durante eventos en vivo.

### RNF-06 — Compatibilidad

El sistema deberá funcionar en:

- Navegadores modernos.
- Dispositivos móviles.
- Tablets y computadoras de escritorio.

### RNF-07 — Trazabilidad

Toda acción administrativa deberá poder auditarse mediante logs persistentes.

### RNF-08 — Mantenibilidad

El sistema deberá desarrollarse con:

- Arquitectura modular.
- Separación de responsabilidades.
- Documentación técnica.
- API documentada.

### RNF-09 — Persistencia

La información crítica no deberá perderse ante:

- Reinicios del servidor.
- Errores de aplicación.
- Caídas parciales del sistema.

### RNF-10 — Accesibilidad

La interfaz deberá cumplir principios básicos de accesibilidad:

- Navegación clara.
- Contraste adecuado.

### RNF-11 — Seguridad

El sistema de ingreso y registro deberá tener algún tipo de protección contra ciberataques de fuerza bruta

## 4. Observaciones Técnicas de Arquitectura

Observaciones Técnicas de Arquitectura

El estado de pago debe ser capaz de actualizarse manualmente a fin de gestionar fácilmente pagos en efectivo.

El QR no debería contener datos sensibles.

- Conviene usar:
  - token firmado,
  - expiración,
  - validación server-side.

El acceso al streaming debe validarse backend-side.

- No solo ocultar botones en frontend.

Se acepta como limitación funcional que la URL directa de YouTube pueda compartirse externamente.

El manejo de cupos requiere control de concurrencia.

- Idealmente:
  - transacciones SQL,
  - row locking,
  - constraints.

El cupo será ocupado únicamente cuando el pago se encuentre aprobado.

Los certificados deberían generarse como PDF firmado o verificable.

El sistema deberá impedir la emisión de certificados a participantes que no cumplan las condiciones configuradas para la jornada.

Los logs son importantes.

- Especialmente:
  - pagos,
  - ingresos,
  - modificaciones administrativas,
  - revocaciones.

