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
        Schema::create('pelicula', function (Blueprint $table) {
            $table->id();
            $table->char('Titulo');
            $table->char('FechaEstreno');
            $table->char('Director');
            $table->char('Generos');
            $table->int('idClasificacion');
            $table->int('idEstado');
            $table->char('Duracion');
            $table->char('Link');
            $table->string('Reparto');
            $table->string('Sinopsis');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelicula');
    }
};
