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
        Schema::create('cine', function (Blueprint $table) {
            $table->id();
            $table->stirng('RazonSocial',30)->notNull();
            $table->unsignedBigInteger('idDistrito');
            $table->string('Direccion',100)->notNull();
            $table->number('Telefonos',20)->notNull();
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
        Schema::dropIfExists('cine');
    }
};
