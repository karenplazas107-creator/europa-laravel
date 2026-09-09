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
        Schema::create('sales_details', function (Blueprint $table) {
            $table->id('detalles_ventas');
            $table->integer('cantidad')->unsigned();
            $table->decimal('precio', 10, 2);
            $table->foreignId('venta')
            ->constrained('sales', 'ventas')
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
        Schema::dropIfExists('sales_details');
    }
};
