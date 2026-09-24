<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetalleVenta extends Model
{
    protected $table = 'sales_details';

    protected $primaryKey = 'detalles_ventas';

    protected $fillable = [
        'venta',
        'producto',
        'cantidad',
        'precio',
    ];

    protected $casts = [
        'cantidad' => 'integer',
        'precio' => 'decimal:2',
    ];

    /* ── Relaciones ── */
    public function ventaObj(): BelongsTo
    {
        return $this->belongsTo(Venta::class, 'venta', 'ventas');
    }

    public function productoObj(): BelongsTo
    {
        return $this->belongsTo(Producto::class, 'producto', 'productos');
    }

    /* ── Accessors ── */
    public function getSubtotalAttribute(): float
    {
        return (float) ($this->cantidad * $this->precio);
    }

    public function getSubtotalFormateadoAttribute(): string
    {
        return '$'.number_format($this->subtotal, 2, ',', '.');
    }

    public function getPrecioFormateadoAttribute(): string
    {
        return '$'.number_format($this->precio, 2, ',', '.');
    }
}
