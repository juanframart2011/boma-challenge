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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id(); // id autoincremental
            $table->string('name', 255); // nombre obligatorio
            $table->text('description')->nullable(); // descripción
            $table->string('image')->nullable(); // ruta de imagen
            $table->string('url')->unique(); // url única y no nula
            $table->boolean('active')->default(true); // activo por default
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade'); // id de usuario que la creó
            $table->timestamps(); // created_at y updated_at
            $table->softDeletes(); // deleted_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};
