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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id('inventario');
            $table->foreignId('producto')
                ->constrained('products', 'productos')
                ->onDelete('cascade');
            $table->integer('stock')->unsigned();
            $table->integer('stock_minimo')->unsigned();
            $table->date('fecha_actualizacion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
