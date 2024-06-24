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
        Schema::create('cine_peliculas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idCine');
            $table->unsignedBigInteger('idPelicula');
            $table->integer('Sala')->notNull();
            $table->char('Horarios', 150)->notNull();
            $table->timestamps();

            $table->foreign('idCine')->references('id')->on('cines')->onDelete('cascade');
            $table->foreign('idPelicula')->references('id')->on('pelicula')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cine_peliculas', function (Blueprint $table) {
            $table->dropForeign(['idCine']);
            $table->dropForeign(['idPelicula']);
        });
        Schema::dropIfExists('cine_peliculas');
        
    }
};
