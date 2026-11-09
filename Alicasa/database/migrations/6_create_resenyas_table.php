<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('resenya', function (Blueprint $table) {
            $table->id();
            $table->integer('valoracion_inmueble');
            $table->integer('valoracion_propietario');
            $table->string('comentario')->nullable($value = true);
            $table->foreignId('usuario')->constrained('usuario')->cascadeOnDelete();
            $table->foreignId('inmueble')->constrained('inmueble')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resenya');
    }
};
