<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table      = 'products';
    protected $primaryKey = 'productos';

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio_compra',
        'precio_venta',
        'categoria',
        'imagen',
        'codigo_barras',
        'stock',
    ];

    protected $casts = [
        'precio_compra' => 'decimal:2',
        'precio_venta'  => 'decimal:2',
        'stock'         => 'integer',
    ];

    /* ── Relaciones ── */
    public function categoriaObj()
    {
        return $this->belongsTo(Categoria::class, 'categoria', 'categoria');
    }

    /* ── Accessors ── */
    public function getEstadoStockAttribute(): string
    {
        if ($this->stock <= 0)  return 'sin_stock';
        if ($this->stock <= 10) return 'bajo';
        return 'disponible';
    }

    public function getEtiquetaStockAttribute(): string
    {
        return match($this->estado_stock) {
            'sin_stock'  => 'Sin Stock',
            'bajo'       => 'Stock Bajo',
            default      => 'Disponible',
        };
    }

    public function getColorStockAttribute(): string
    {
        return match($this->estado_stock) {
            'sin_stock' => '#ef4444',
            'bajo'      => '#f59e0b',
            default     => '#22c55e',
        };
    }

    public function getPrecioFormateadoAttribute(): string
    {
        return '$' . number_format($this->precio_venta, 2, ',', '.');
    }
}
