<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'products';

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
        'stock_minimo',
    ];

    protected $casts = [
        'precio_compra' => 'decimal:2',
        'precio_venta' => 'decimal:2',
        'stock' => 'integer',
        'stock_minimo' => 'integer',
    ];

    /* ── Relaciones ── */
    public function categoriaObj()
    {
        return $this->belongsTo(Categoria::class, 'categoria', 'categoria');
    }

    /* ── Accessors ── */
    public function getEstadoStockAttribute(): string
    {
        if ($this->stock <= 0) {
            return 'agotado';
        }

        $min = $this->stock_minimo ?? 10;
        if ($this->stock <= $min) {
            return 'bajo';
        }

        return 'disponible';
    }

    public function getEtiquetaStockAttribute(): string
    {
        return match ($this->estado_stock) {
            'agotado', 'sin_stock' => 'Agotado',
            'bajo' => 'Stock Bajo',
            default => 'Disponible',
        };
    }

    public function getColorStockAttribute(): string
    {
        return match ($this->estado_stock) {
            'agotado', 'sin_stock' => '#f43f5e',
            'bajo' => '#f59e0b',
            default => '#10b981',
        };
    }

    public function getPrecioFormateadoAttribute(): string
    {
        return '$'.number_format($this->precio_venta, 0, ',', '.');
    }

    public function getValorInventarioAttribute(): float
    {
        return (float) ($this->stock * $this->precio_compra);
    }

    public function getImagenUrlAttribute(): string
    {
        if (! empty($this->imagen)) {
            if (str_starts_with($this->imagen, 'http://') || str_starts_with($this->imagen, 'https://')) {
                return $this->imagen;
            }

            return asset('storage/'.$this->imagen);
        }

        $nombre = strtolower($this->nombre);
        $catNombre = strtolower($this->categoriaObj?->nombre ?? '');

        if (str_contains($nombre, 'chanel')) {
            return 'https://images.unsplash.com/photo-1592945403244-b3fbafd7f539?w=500&h=380&fit=crop&auto=format';
        }
        if (str_contains($nombre, 'gucci') || str_contains($nombre, 'gorra')) {
            return 'https://images.unsplash.com/photo-1588850561407-ed78c282e89b?w=500&h=380&fit=crop&auto=format';
        }
        if (str_contains($nombre, 'oral-b') || str_contains($nombre, 'cepillo')) {
            return 'https://images.unsplash.com/photo-1559591937-e1032b4f9814?w=500&h=380&fit=crop&auto=format';
        }
        if (str_contains($nombre, 'oud') || (str_contains($nombre, 'king') && str_contains($catNombre, 'perfum'))) {
            return 'https://images.unsplash.com/photo-1523293182086-7651a899d37f?w=500&h=380&fit=crop&auto=format';
        }
        if (str_contains($nombre, 'ariel') || str_contains($nombre, 'detergente') || str_contains($catNombre, 'aseo')) {
            return 'https://images.unsplash.com/photo-1583947581924-860bda6a26df?w=500&h=380&fit=crop&auto=format';
        }
        if (str_contains($nombre, 'martillo') || str_contains($catNombre, 'herramient')) {
            return 'https://images.unsplash.com/photo-1586864387967-d02ef85d93e8?w=500&h=380&fit=crop&auto=format';
        }
        if (str_contains($nombre, 'reloj') || str_contains($catNombre, 'reloj')) {
            return 'https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?w=500&h=380&fit=crop&auto=format';
        }
        if (str_contains($nombre, 'arroz') || str_contains($catNombre, 'abarrote')) {
            return 'https://images.unsplash.com/photo-1586201375761-83865001e31c?w=500&h=380&fit=crop&auto=format';
        }
        if (str_contains($nombre, 'crocs') || str_contains($nombre, 'sandalia') || str_contains($catNombre, 'zandalia')) {
            return 'https://images.unsplash.com/photo-1603808033192-082d6919d3e1?w=500&h=380&fit=crop&auto=format';
        }
        if (str_contains($catNombre, 'ropa') || str_contains($nombre, 'polo') || str_contains($catNombre, 'blusa')) {
            return 'https://images.unsplash.com/photo-1521572267360-ee0c2909d518?w=500&h=380&fit=crop&auto=format';
        }
        if (str_contains($catNombre, 'perfum')) {
            return 'https://images.unsplash.com/photo-1541643600914-78b084683601?w=500&h=380&fit=crop&auto=format';
        }

        return 'https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?w=500&h=380&fit=crop&auto=format';
    }
}
