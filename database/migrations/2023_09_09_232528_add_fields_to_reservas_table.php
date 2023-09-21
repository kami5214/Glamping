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
        Schema::table('reservas', function (Blueprint $table) {
            $table->integer('res_cantidad_per')->after('res_fecha_registro');
            $table->unsignedBigInteger('usu_cedula')->unsigned();
            $table->foreign('usu_cedula')->references('id')->on('users');
            $table->unsignedBigInteger('cli_cedula')->unsigned();
            $table->foreign('cli_cedula')->references('id')->on('clientes');
            $table->unsignedBigInteger('dom_codigo')->unsigned();
            $table->foreign('dom_codigo')->references('dom_codigo')->on('domos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservas', function (Blueprint $table) {
            //
        });
    }
};
