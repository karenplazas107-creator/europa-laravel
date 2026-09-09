<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table      = 'suppliers';
    protected $primaryKey = 'proveedores';

    protected $fillable = [
        'nombre',
        'telefono',
        'email',
        'direccion',
    ];

    /**
     * Devuelve las iniciales del nombre para el avatar (máx 2 letras).
     */
    public function getInitialesAttribute(): string
    {
        $words = explode(' ', trim($this->nombre));
        $ini   = strtoupper(substr($words[0], 0, 1));
        if (isset($words[1])) {
            $ini .= strtoupper(substr($words[1], 0, 1));
        }
        return $ini;
    }

    /**
     * ID formateado: #0001
     */
    public function getIdFormateadoAttribute(): string
    {
        return '#' . str_pad($this->proveedores, 4, '0', STR_PAD_LEFT);
    }
}
