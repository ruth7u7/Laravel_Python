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
        Schema::create('sala', function (Blueprint $table) {
            $table->unsignedBigInteger('n_id_sala');
            $table->unsignedBigInteger('n_id_cine');
            $table->timestamps();
            $table->foreign('n_id_cine')->references('n_id_cine')->on('cine')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sala', function (Blueprint $table) {
            $table->dropForeign(['n_id_cine']);
        });
        Schema::dropIfExists('sala');
    }
};
