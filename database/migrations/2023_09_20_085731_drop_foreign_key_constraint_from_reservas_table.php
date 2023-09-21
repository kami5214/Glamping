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
            $table->dropForeign('reservas_cli_cedula_foreign');
            $table->dropColumn('cli_cedula');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservas', function (Blueprint $table) {
            $table->unsignedBigInteger('cli_cedula');
            $table->foreign('cli_cedula')->references('id')->on('clientes');
        });
    }
};
