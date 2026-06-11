<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null')->onUpdate('cascade');
            $table->foreignId('event_id')->nullable()->constrained('events')->onDelete('set null')->onUpdate('cascade');
            $table->string('action_type', 100);
            $table->enum('actor_type', ['admin', 'system'])->default('admin');
            $table->string('affected_table', 100);
            $table->unsignedBigInteger('entity_id');
            $table->timestamp('created_at')->useCurrent();

            $table->index(['user_id'], 'idx_logs_user');
            $table->index(['event_id'], 'idx_logs_event');
            $table->index(['affected_table', 'entity_id'], 'idx_logs_entity');
            $table->index(['created_at'], 'idx_logs_created');
            $table->index(['action_type'], 'idx_logs_action');
        });
        /* CREATE TABLE logs (
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
SET FOREIGN_KEY_CHECKS = 1; */
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
