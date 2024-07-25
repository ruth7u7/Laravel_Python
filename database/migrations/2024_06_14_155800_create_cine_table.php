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
            $table->bigIncrements('n_id_cine');
            $table->unsignedBigInteger('n_id_distrito');
            $table->stirng('v_razon_social',30)->notNull();
            $table->string('v_direccion',100)->notNull();
            $table->integer('n_telefonos',9)->notNull();
            $table->timestamps();
            $table->foreign('n_id_distrito')->references('id')->on('distrito')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cine', function (Blueprint $table) {
            $table->dropForeign(['n_id_distrito']);
        });
        Schema::dropIfExists('cine');
    }
};
