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
        Schema::create('domos', function (Blueprint $table) {
            $table->id('dom_codigo');
            $table->string('dom_nombre')->unique();;
            $table->string('dom_estado');
            $table->integer('dom_precio');
            $table->string('dom_ubicacion');
            $table->string('dom_descripcion');
            $table->string('dom_capacidad');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('domos');
    }
};
