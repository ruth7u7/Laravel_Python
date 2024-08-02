<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pelicula', function (Blueprint $table) {
            $table->unsignedBigInteger('n_id_pelicula')->primary();
            $table->string('v_titulo', 80);
            $table->date('d_fechaestreno');
            $table->string('v_director', 50);
            $table->unsignedBigInteger('n_id_clasificacion');
            $table->unsignedBigInteger('n_id_estado');
            $table->unsignedInteger('n_duracion');
            $table->string('v_link', 20)->nullable();
            $table->string('v_reparto', 300)->nullable();
            $table->string('v_sinopsis', 1230)->nullable();
        });

        // Crear la secuencia
        DB::statement('CREATE SEQUENCE PELICULA_N_ID_PELICULA_seq START WITH 1 INCREMENT BY 1 NOCACHE');

        // Crear el trigger
        DB::unprepared('
            CREATE OR REPLACE TRIGGER PELICULA_N_ID_PELICULA_TRG 
            BEFORE INSERT ON PELICULA 
            FOR EACH ROW 
            WHEN (NEW.N_ID_PELICULA IS NULL) 
            BEGIN
                :new.n_id_pelicula := pelicula_n_id_pelicula_seq.nextval;
            END;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Eliminar el trigger
        DB::unprepared('DROP TRIGGER PELICULA_N_ID_PELICULA_TRG');

        // Eliminar la secuencia
        DB::statement('DROP SEQUENCE PELICULA_N_ID_PELICULA_seq');

        // Eliminar la tabla
        Schema::dropIfExists('pelicula');
    }
};