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
        Schema::create('recibos', function (Blueprint $table) {
            $table->id('rec_codigo');
            $table->unsignedBigInteger('res_codigo')->unsigned();
            $table->foreign('res_codigo')->references('id')->on('reservas');
            $table->double('rec_subtotal');
            $table->double('rec_descuento');
            $table->double('rec_iva');
            $table->double('rec_total');
            $table->date('rec_fecha');
            $table->unsignedBigInteger('met_codigo')->unsigned();
            $table->foreign('met_codigo')->references('met_codigo')->on('metodos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recibos');
    }
};
