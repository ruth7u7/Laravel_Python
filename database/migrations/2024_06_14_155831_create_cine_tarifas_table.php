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
        Schema::create('cine_tarifas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idCine');
            $table->char('diasSemana');
            $table->decimal('Precio', 5, 2);
            $table->timestamps();
            $table->foreign('idCine')->references('id')->on('cines')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cine_tarifas', function (Blueprint $table) {
            $table->dropForeign(['idCine']);
        });

        Schema::dropIfExists('cine_tarifas');
    }
};
