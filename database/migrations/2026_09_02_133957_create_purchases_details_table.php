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
        Schema::create('purchases_details', function (Blueprint $table) {
             $table->id('detalle_compra');
            $table->date('fecha');
            $table->decimal('total', 10, 2)->unsigned();
            $table->foreignId('compra')
            ->constrained('purchases', 'compra')
            ->onDelete('cascade');
            $table->foreignId('producto')
            ->constrained('products', 'productos')
            ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases_details');
    }
};
