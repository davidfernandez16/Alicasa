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
        Schema::create('reserva', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->integer('dias')->virtualAs('GREATEST(DATEDIFF(fecha_fin, fecha_inicio), 1)');
            $table->float('precio_total')->nullable();
            $table->enum('estado', ['Pendiente', 'Aceptada', 'Cancelada'])->default('Pendiente');
            $table->foreignId('usuario')->constrained('usuario')->cascadeOnDelete();
            $table->foreignId('inmueble')->constrained('inmueble')->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reserva');
    }
};