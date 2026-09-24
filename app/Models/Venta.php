<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Venta extends Model
{
    protected $table = 'sales';

    protected $primaryKey = 'ventas';

    protected $fillable = [
        'usuario',
        'fecha',
        'total',
        'metodo_pago',
        'direccion_envio',
        'ciudad',
        'departamento',
        'documento',
        'telefono',
        'notas',
        'estado',
    ];

    protected $casts = [
        'fecha' => 'date',
        'total' => 'decimal:2',
    ];

    /* ── Relaciones ── */
    public function usuarioObj(): BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario', 'usuario');
    }

    public function detalles(): HasMany
    {
        return $this->hasMany(DetalleVenta::class, 'venta', 'ventas');
    }

    /* ── Accessors ── */
    public function getNumeroVentaAttribute(): string
    {
        return sprintf('#%06d', $this->ventas);
    }

    public function getTotalFormateadoAttribute(): string
    {
        return '$'.number_format($this->total, 2, ',', '.');
    }

    public function getFechaFormateadaAttribute(): string
    {
        return Carbon::parse($this->created_at ?? $this->fecha)->format('d/m/Y');
    }

    public function getHoraFormateadaAttribute(): string
    {
        return Carbon::parse($this->created_at ?? $this->fecha)->format('h:i A');
    }

    public function getInicialResponsableAttribute(): string
    {
        $nombre = $this->usuarioObj?->nombre ?? '';

        return $nombre !== '' ? strtoupper(substr($nombre, 0, 1)) : '?';
    }

    public function getNombreResponsableAttribute(): string
    {
        if (! $this->usuarioObj) {
            return 'Usuario desconocido';
        }

        return trim("{$this->usuarioObj->nombre} {$this->usuarioObj->apellido}");
    }
}
