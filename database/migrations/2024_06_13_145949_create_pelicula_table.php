<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pelicula', function (Blueprint $table) {
            $table->bigIncrements('n_id_pelicula');
            $table->string('v_titulo', 80)->notNull();
            $table->date('d_fechaestreno')->notNull();
            $table->string('v_director', 50)->notNull();
            $table->integer('n_id_clasificacion')->notNull();
            $table->integer('n_id_estado')->notNull();
            $table->integer('n_duracion', 3)->notNull();
            $table->string('v_link', 20);
            $table->string('v_reparto', 300);
            $table->string('v_sinopsis', 1230);
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
