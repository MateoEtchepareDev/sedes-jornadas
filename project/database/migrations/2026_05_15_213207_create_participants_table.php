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
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events')->onDelete('restrict')->onUpdate('cascade');
            $table->string('full_name');
            $table->string('dni', 20);
            $table->string('email');
            $table->enum('modality', ['in_person', 'virtual']);
            $table->enum('payment_status', ['pending', 'approved', 'rejected',
                'refunded', 'charged_back', 'cancelled'])->default('pending');
            $table->string('payment_external_id')->nullable(); // ID de pago externo (Mercado Pago), NULL si es pago manual o gratuito
            // Campos para modalidad presencial
            $table->string('qr_token', 500)->nullable(); // JWT firmado, NULL si es virtual
            $table->boolean('checkin_confirmed')->nullable(); // NULL si es virtual
            // Campos para modalidad virtual
            $table->string('access_code', 64)->nullable(); // Código de acceso al stream, NULL si es presencial
            $table->boolean('questions_completed')->nullable(); // NULL si es presencial
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
