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
        Schema::create('comments', function (Blueprint $table) {
            $table->id(); // identifica al comentador

            $table->foreignId('participant_id')->constrained('participants')->onDelete('restrict')->onUpdate('cascade'); // id del participante que hace el comentario
            $table->string('full_name');
            $table->text('message'); //comentario
            $table->timestamps(); //fecha y hora del comentario
        });
    }

    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
