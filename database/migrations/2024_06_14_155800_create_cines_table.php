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
        Schema::create('cines', function (Blueprint $table) {
            $table->id();
            $table->char('RazonSocial',30);
            $table->integer('Salas');
            $table->unsignedBigInteger('idDistrito');
            $table->char('Direccion',100);
            $table->char('Telefonos',20);
            $table->timestamps();

            $table->foreign('idDistrito')->references('id')->on('distritos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cines', function (Blueprint $table) {
            $table->dropForeign(['idDistrito']);
        });
        Schema::dropIfExists('cines');
    }
};
