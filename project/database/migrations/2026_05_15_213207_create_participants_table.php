<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();

            $table->foreignId('event_id')
                ->constrained('events')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->string('full_name');
            $table->string('dni', 20);
            $table->string('email');
            $table->string('role');

            $table->enum('modality', ['in_person', 'virtual']);

            $table->enum('payment_status', [
                'pending',
                'approved',
                'rejected',
                'refunded',
                'charged_back',
                'cancelled'
            ])->default('pending');

            $table->enum('payment_method', [
                'mercado_pago',
                'cash'
            ])->default('mercado_pago');

            $table->string('payment_external_id')->nullable();

            // Presencial
            $table->string('qr_token', 500)->nullable();
            $table->boolean('checkin_confirmed')->nullable();

            // Virtual
            $table->string('access_code', 20)->nullable()->unique();
            $table->boolean('stream_used')->default(false);
            $table->string('device_token')->nullable();
            $table->boolean('questions_completed')->nullable();

            $table->dateTime('registered_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('paid_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participants');
    }
};