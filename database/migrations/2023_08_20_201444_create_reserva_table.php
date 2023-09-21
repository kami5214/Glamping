
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
        Schema::create('reserva', function (Blueprint $table) {
            $table->id();
            $table->date('res_fecha_ini');
            $table->date('res_fecha_fin');
            //$table->unsignedBigInteger('usu_cedula')->unsigned();
            $table->date('res_fecha_registro');
            $table->double('res_subtotal');
            $table->double('res_descuento');
            $table->double('res_iva');
            $table->double('res_total');
            $table->timestamps();

            //$table->foreign('usu_cedula')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reserva');
    }
};
