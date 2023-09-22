
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
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->date('res_fecha_ini');
            $table->date('res_fecha_fin');
            //$table->unsignedBigInteger('usu_cedula')->unsigned();
            $table->date('res_fecha_registro');
            $table->string('res_estado')->default('activo');
            $table->double('res_descuento');
            $table->double('res_total');
            $table->timestamps();
            $table->integer('res_cantidad_per');
            $table->unsignedBigInteger('usu_cedula');
            $table->unsignedBigInteger('dom_codigo');
            $table->unsignedBigInteger('cli_cedula');

            $table->foreign('usu_cedula')->references('id')->on('users');
            $table->foreign('dom_codigo')->references('dom_codigo')->on('domos');
            $table->foreign('cli_cedula')->references('id')->on('clientes');
            //$table->foreign('usu_cedula')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
