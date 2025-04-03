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
        Schema::create('roles', function (Blueprint $table) {
            $table->id(); // id autoincremental
            $table->string('name')->unique(); // nombre único
            $table->text('description')->nullable(); // descripción opcional
            $table->timestamps(); // created_at y updated_at
            $table->softDeletes(); // deleted_at para softDeletes
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
