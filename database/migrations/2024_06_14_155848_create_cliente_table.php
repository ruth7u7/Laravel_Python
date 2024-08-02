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
        Schema::create('cliente', function (Blueprint $table) {
            $table->unsignedBigInteger('n_id_cliente');
            $table->unsignedBigInteger('n_id_sala');
            $table->string('v_nombres',30)->notNull();
            $table->string('v_correo',50)->notNull();
            $table->string('v_contrasena',20)->notNull();
            $table->timestamps();
            $table->foreign('n_id_sala')->references('n_id_sala')->on('sala')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cliente', function (Blueprint $table) {
            $table->dropForeign(['n_id_sala']);
        });
        Schema::dropIfExists('cliente');
    }
};
