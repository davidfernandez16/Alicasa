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
        Schema::create('inmueble', function (Blueprint $table) {
            $table->id();
            $table->string('direccion');
            $table->integer('num_habitaciones');
            $table->integer('superficie');
            $table->string('categoria');
            $table->float('precio');
            $table->string('imagen')->default('img/inmueble.png');
            $table->string('descripcion')->nullable();
            $table->boolean('wifi');
            $table->boolean('piscina');
            $table->foreignId('ciudad')->constrained('ciudad')->cascadeOnDelete();
            $table->foreignId('propietario')->constrained('usuario')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inmueble');
    }
};
