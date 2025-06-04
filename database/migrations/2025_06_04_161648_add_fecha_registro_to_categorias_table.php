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
        Schema::table('categorias', function (Blueprint $table) {
            // Esto añade una columna 'mi_fecha' de tipo DATETIME, que puede ser nula.
            // Si quieres que sea obligatoria, quita ->nullable().
            $table->dateTime('mi_fecha')->nullable()->after('updated_at');
            // O puedes usar $table->timestamp() si prefieres ese tipo
            // $table->timestamp('mi_timestamp')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categorias', function (Blueprint $table) {
            $table->dropColumn('mi_fecha');
        });
    }
};