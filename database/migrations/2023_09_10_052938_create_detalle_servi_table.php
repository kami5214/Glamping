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
        Schema::create('detalle_servi', function (Blueprint $table) {
            $table->id('detse_codigo');
            $table->unsignedBigInteger('ser_codigo')->unsigned();
            $table->foreign('ser_codigo')->references('ser_codigo')->on('servicios');
            $table->unsignedBigInteger('res_codigo')->unsigned();
            $table->foreign('res_codigo')->references('id')->on('reservas');
            $table->integer('detse_precio');
            $table->integer('detse_cantidad');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_servi');
    }
};
