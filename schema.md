# Schema — Sistema de Gestión de Jornadas

Motor: MySQL 8.0+

```sql
SET FOREIGN_KEY_CHECKS = 0;
SET NAMES utf8mb4;
```

## users

- Solo administradores. Sin registro público.
- El primer admin se crea por seed/script.

```sql
CREATE TABLE users (
    id            BIGINT UNSIGNED  NOT NULL AUTO_INCREMENT,
    full_name     VARCHAR(255)     NOT NULL,
    email         VARCHAR(255)     NOT NULL,
    password_hash VARCHAR(255)     NOT NULL,
    is_admin      TINYINT(1)       NOT NULL DEFAULT 1,
    created_at    DATETIME         NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at    DATETIME         NOT NULL DEFAULT CURRENT_TIMESTAMP
                                            ON UPDATE CURRENT_TIMESTAMP,

    PRIMARY KEY (id),
    UNIQUE KEY uq_users_email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

## events

- status controla visibilidad y ciclo de vida del evento.
- price = 0.00 equivale a evento gratuito.

```sql
CREATE TABLE events (
    id                      BIGINT UNSIGNED  NOT NULL AUTO_INCREMENT,
    title                   VARCHAR(255)     NOT NULL,
    description             TEXT             NOT NULL,
    price                   DECIMAL(10,2)    NOT NULL DEFAULT 0.00,
    stream_url              VARCHAR(500)         NULL,
    registration_opens_at   DATETIME             NULL,
    registration_closes_at  DATETIME             NULL,
    event_starts_at         DATETIME         NOT NULL,
    event_ends_at           DATETIME         NOT NULL,
    max_participants        SMALLINT UNSIGNED    NULL,   -- NULL = sin límite
    status                  ENUM(
                                'draft',        -- borrador, invisible
                                'published',    -- visible, inscripciones abiertas
                                'active',       -- evento en curso
                                'finished',     -- finalizado
                                'cancelled'     -- cancelado
                            ) NOT NULL DEFAULT 'draft',
    created_at              DATETIME         NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at              DATETIME         NOT NULL DEFAULT CURRENT_TIMESTAMP
                                                      ON UPDATE CURRENT_TIMESTAMP,

    PRIMARY KEY (id),
    KEY idx_events_status (status),
    KEY idx_events_starts (event_starts_at),

    CONSTRAINT chk_events_dates CHECK (event_ends_at > event_starts_at),
    CONSTRAINT chk_events_reg_dates CHECK (
        registration_closes_at IS NULL
        OR registration_opens_at IS NULL
        OR registration_closes_at > registration_opens_at
    ),
    CONSTRAINT chk_events_price CHECK (price >= 0)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

## participants

- Campos dependientes de modalidad:
  - in_person → qr_token se genera al confirmar pago
                checkin_confirmed se marca en puerta
                access_code siempre NULL
  - virtual   → access_code se genera al confirmar pago
                questions_completed se marca al finalizar cuestionario
                qr_token siempre NULL
                checkin_confirmed siempre NULL
- payment_external_id: ID de pago de Mercado Pago.
  - NULL si el pago fue gestionado manualmente (efectivo).
- paid_at: se registra cuando payment_status pasa a 'approved'.

```sql
CREATE TABLE participants (
    id                    BIGINT UNSIGNED   NOT NULL AUTO_INCREMENT,
    event_id              BIGINT UNSIGNED   NOT NULL,
    full_name             VARCHAR(255)      NOT NULL,
    dni                   VARCHAR(20)       NOT NULL,
    email                 VARCHAR(255)      NOT NULL,
    modality              ENUM(
                              'in_person',
                              'virtual'
                          ) NOT NULL,
    payment_status        ENUM(
                              'pending',    -- esperando pago
                              'approved',   -- pago confirmado
                              'rejected',   -- pago rechazado
                              'refunded', 'charged_back', 'cancelled'
                          ) NOT NULL DEFAULT 'pending',
    payment_external_id   VARCHAR(255)      NULL,   -- ID de Mercado Pago. NULL si es manual/gratuito

    -- campos in_person
    qr_token              VARCHAR(500)      NULL,   -- JWT firmado. NULL si es virtual
    checkin_confirmed     TINYINT(1)        NULL,   -- NULL si es virtual

    -- campos virtual
    access_code           VARCHAR(64)       NULL,   -- código de acceso al stream. NULL si es presencial
    questions_completed   TINYINT(1)        NULL,   -- NULL si es presencial

    registered_at         DATETIME          NOT NULL DEFAULT CURRENT_TIMESTAMP,
    paid_at               DATETIME          NULL,
    updated_at            DATETIME          NOT NULL DEFAULT CURRENT_TIMESTAMP
                                                     ON UPDATE CURRENT_TIMESTAMP,

    PRIMARY KEY (id),
    UNIQUE KEY uq_participant_event (event_id, dni),    -- un DNI no puede inscribirse dos veces al mismo evento
    UNIQUE KEY uq_qr_token (qr_token),
    UNIQUE KEY uq_access_code (access_code),
    KEY idx_participants_event (event_id),
    KEY idx_participants_email (email),
    KEY idx_participants_payment_status (payment_status),
    KEY idx_participants_payment_ext (payment_external_id),

    CONSTRAINT fk_participants_event
        FOREIGN KEY (event_id) REFERENCES events (id)
        ON DELETE RESTRICT ON UPDATE CASCADE,

    -- integridad por modalidad
    CONSTRAINT chk_modality_in_person CHECK (
        modality != 'in_person'
        OR (access_code IS NULL AND questions_completed IS NULL)
    ),
    CONSTRAINT chk_modality_virtual CHECK (
        modality != 'virtual'
        OR (qr_token IS NULL AND checkin_confirmed IS NULL)
    ),
    CONSTRAINT chk_free_no_ext_id CHECK (
        payment_status != 'free'
        OR payment_external_id IS NULL
    )
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

## certificates

- Se emite uno por participante aprobado.
- certificate_uuid es el código público de verificación.

```sql
CREATE TABLE certificates (
    id                  BIGINT UNSIGNED  NOT NULL AUTO_INCREMENT,
    participant_id      BIGINT UNSIGNED  NOT NULL,
    certificate_uuid    CHAR(36)         NOT NULL,   -- UUIDv4
    issued_at           DATETIME         NOT NULL DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY (id),
    UNIQUE KEY uq_certificates_participant (participant_id),    -- un certificado por participante
    UNIQUE KEY uq_certificates_uuid (certificate_uuid),

    CONSTRAINT fk_certificates_participant
        FOREIGN KEY (participant_id) REFERENCES participants (id)
        ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

## logs

- Auditoría completa. user_id es nullable porque acciones
  del sistema (webhooks de MP, emails automáticos, etc.)
  no tienen un usuario admin asociado.
- before/after guardan snapshot JSON del registro afectado.

```sql
CREATE TABLE logs (
    id              BIGINT UNSIGNED  NOT NULL AUTO_INCREMENT,
    user_id         BIGINT UNSIGNED      NULL,   -- NULL si la acción es del sistema
    event_id        BIGINT UNSIGNED      NULL,
    action_type     VARCHAR(100)     NOT NULL,   -- 'payment_approved', 'checkin', 'cert_issued', etc.
    actor_type      ENUM(
                        'admin',
                        'system'    -- webhook, proceso automático
                    ) NOT NULL DEFAULT 'admin',
    affected_table  VARCHAR(100)     NOT NULL,
    entity_id       BIGINT UNSIGNED  NOT NULL,
    before_data     JSON                 NULL,
    after_data      JSON                 NULL,
    created_at      DATETIME         NOT NULL DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY (id),
    KEY idx_logs_user (user_id),
    KEY idx_logs_event (event_id),
    KEY idx_logs_entity (affected_table, entity_id),
    KEY idx_logs_created (created_at),
    KEY idx_logs_action (action_type),

    CONSTRAINT fk_logs_user
        FOREIGN KEY (user_id) REFERENCES users (id)
        ON DELETE SET NULL ON UPDATE CASCADE,

    CONSTRAINT fk_logs_event
        FOREIGN KEY (event_id) REFERENCES events (id)
        ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

```sql
SET FOREIGN_KEY_CHECKS = 1;
```