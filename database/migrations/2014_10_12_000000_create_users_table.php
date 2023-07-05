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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('usuario',100)->nullable(false);
            $table->string('contrasena',500)->nullable(false);
            $table->string('nombres',100)->nullable(false);
            $table->string('primerApellido', 100)->nullable(false);
            $table->string('segundoApellido', 100)->nullable(false);
            $table->string('estado', 8)->default('Activo');
            // $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
