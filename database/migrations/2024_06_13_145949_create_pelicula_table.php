<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pelicula', function (Blueprint $table) {
            $table->id();
            $table->char('Titulo', 80);
            $table->date('FechaEstreno');
            $table->char('Director', 50);
            $table->char('Generos', 10);
            $table->integer('idClasificacion');
            $table->integer('idEstado');
            $table->char('Duracion', 3);
            $table->char('Link', 20);
            $table->text('Reparto', 300);
            $table->text('Sinopsis', 800);
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
