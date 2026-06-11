
// Lista de rutas API del sistema: sólo estructura y comportamiento esperado.

// Obtener listado de eventos: devuelve eventos publicados y datos para filtro en frontend.
// Obtener detalle de evento: devuelve datos completos del evento, cupo disponible y configuración de inscripción.
// Crear inscripción de participante: valida cupo, límite de registro y crea la inscripción inicial en estado 'pending'.
// Consultar estado de inscripción: devuelve el estado actual de pago y datos de la inscripción.
// Generar pago con Mercado Pago: crea la preferencia de pago y devuelve la URL o datos de checkout.
// Webhook de pago: recibe notificaciones de Mercado Pago y actualiza el estado de pago del participante.
// Validar QR de entrada: recibe el token QR y marca el ingreso del participante si el pago está aprobado.
// Obtener datos de transmisión: verifica acceso y devuelve los datos necesarios para mostrar el iframe seguro.
// Obtener certificado: valida si el participante tiene derecho al certificado y devuelve la URL/UUID de descarga.
// Autenticación admin API: administra sesión de administrador para proteger rutas internas.
// CRUD de eventos admin: crea, actualiza, publica/oculta y elimina eventos desde la API admin.
// CRUD de participantes admin: consulta inscriptos, actualiza estado de pago y gestiona controles administrativos.
// Consultar logs/admin: devuelve auditoría para acciones relevantes siempre que el admin esté autorizado.
