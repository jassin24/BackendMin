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
        Schema::create('favoritos', function (Blueprint $table) {
            // $table->id();
            $table->bigInteger('idusuario')->unsigned();
            $table->foreign('idusuario')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('idpelicula')->unsigned();
            $table->foreign('idpelicula')->references('id')->on('peliculas')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favoritos');
    }
};
