<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('imagen')->nullable()->after('categoria');
            $table->string('codigo_barras')->nullable()->unique()->after('imagen');
            $table->unsignedInteger('stock')->default(0)->after('codigo_barras');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['imagen', 'codigo_barras', 'stock', 'created_at', 'updated_at']);
        });
    }
};
