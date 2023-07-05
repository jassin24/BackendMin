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
        Schema::create('peliculas', function (Blueprint $table) {
            $table->id();
            $table->string('imdbID',10)->nullable(false);
            $table->string('Title',100)->nullable(false);
            $table->string('Year',4)->nullable(false);
            $table->string('Actors',240)->nullable(false);
            $table->string('Director',240)->nullable(false);
            $table->string('Poster',150)->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peliculas');
    }
};
