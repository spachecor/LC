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
        Schema::create('libros', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('título')->nullable();
            $table->integer('isbn')->nullable();
            $table->string('autor')->nullable();
            $table->string('editorial')->nullable();
            $table->integer('num_páginas')->nullable();
            $table->text('categoría')->nullable();
            $table->float('pvp')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('libros');
    }
};
