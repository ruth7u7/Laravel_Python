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
        Schema::create('cinetarifa', function (Blueprint $table) {
            $table->unsignedBigInteger('n_id_cine');
            $table->string('v_dias_semana');
            $table->decimal('d_precio', 5, 2);
            $table->timestamps();
            $table->foreign('n_id_cine')->references('id')->on('cine')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cinetarifa', function (Blueprint $table) {
            $table->dropForeign(['n_id_cine']);
        });

        Schema::dropIfExists('cinetarifa');
    }
};
