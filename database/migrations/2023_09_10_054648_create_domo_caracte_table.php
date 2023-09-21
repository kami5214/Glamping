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
        Schema::create('domo_caracte', function (Blueprint $table) {
            $table->id('doca_codigo');
            $table->unsignedBigInteger('car_codigo')->unsigned();
            $table->foreign('car_codigo')->references('car_codigo')->on('caracteristicas');
            $table->unsignedBigInteger('dom_codigo')->unsigned();
            $table->foreign('dom_codigo')->references('dom_codigo')->on('domos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('domo_caracte');
    }
};
