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
        Schema::table('sales', function (Blueprint $table) {
            $table->string('direccion_envio')->nullable()->after('metodo_pago');
            $table->string('ciudad')->nullable()->after('direccion_envio');
            $table->string('departamento')->nullable()->after('ciudad');
            $table->string('documento')->nullable()->after('departamento');
            $table->string('telefono')->nullable()->after('documento');
            $table->text('notas')->nullable()->after('telefono');
            $table->string('estado')->default('completado')->after('notas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->dropColumn([
                'direccion_envio',
                'ciudad',
                'departamento',
                'documento',
                'telefono',
                'notas',
                'estado',
            ]);
        });
    }
};
