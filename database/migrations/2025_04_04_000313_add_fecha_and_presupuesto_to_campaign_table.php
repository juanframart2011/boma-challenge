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
        Schema::table('campaigns', function (Blueprint $table) {
            $table->date('fecha')->nullable()->after('active'); // campo fecha
            $table->decimal('presupuesto', 10, 2)->default(0.00)->after('fecha'); // campo presupuesto
        });
    }

    public function down(): void
    {
        Schema::table('campaigns', function (Blueprint $table) {
            $table->dropColumn(['fecha', 'presupuesto']);
        });
    }
};
