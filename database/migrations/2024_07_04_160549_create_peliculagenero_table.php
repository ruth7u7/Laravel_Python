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
        Schema::create('peliculagenero', function (Blueprint $table) {
            $table->unsignedBigInteger('n_id_pelicula');
            $table->unsignedBigInteger('n_id_genero');
            $table->timestamps();
            $table->foreign('n_id_pelicula')->references('n_id_pelicula')->on('pelicula')->onDelete('cascade');
            $table->foreign('n_id_genero')->references('n_id_genero')->on('genero')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peliculagenero', function (Blueprint $table) {
            $table->dropForeign(['n_id_pelicula']);
            $table->dropForeign(['n_id_genero']);
        });
        Schema::dropIfExists('peliculagenero');
    }
};
