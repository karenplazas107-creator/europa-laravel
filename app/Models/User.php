<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Clave primaria personalizada.
     */
    protected $primaryKey = 'usuario';

    /**
     * Columna usada para autenticación (en lugar de email).
     * Usamos 'movil' como identificador único de login.
     */
    // Si prefieres login por movil cambia también AUTH_IDENTIFIER abajo.

    protected $fillable = [
        'rol',
        'nombre',
        'apellido',
        'email',
        'movil',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    /**
     * Clave primaria para identificar al usuario en la sesión.
     */
    public function getAuthIdentifierName(): string
    {
        return 'usuario';
    }

    public const ROL_ADMIN = 'administrador';

    public const ROL_VENDEDOR = 'vendedor';

    public const ROL_BODEGA = 'auxiliar_bodega';

    public const ROL_CLIENTE = 'cliente';

    /**
     * Lista de roles disponibles en el sistema con sus etiquetas legibles.
     *
     * @return array<string, string>
     */
    public static function rolesDisponibles(): array
    {
        return [
            self::ROL_ADMIN => 'Administrador',
            self::ROL_VENDEDOR => 'Vendedor',
            self::ROL_BODEGA => 'Auxiliar de Bodega',
            self::ROL_CLIENTE => 'Cliente',
        ];
    }

    /**
     * Mutator para almacenar siempre el rol en minúsculas y sin espacios.
     */
    public function setRolAttribute($value): void
    {
        $this->attributes['rol'] = strtolower(trim((string) $value));
    }

    public function getRolNormalizadoAttribute(): string
    {
        return strtolower(trim((string) $this->rol));
    }

    public function getNombreRolAttribute(): string
    {
        return match ($this->rol_normalizado) {
            'admin', 'administrador' => 'Administrador',
            'vendedor' => 'Vendedor',
            'auxiliar_bodega', 'bodega', 'auxiliar de bodega' => 'Auxiliar de Bodega',
            'cliente' => 'Cliente',
            default => ucfirst($this->rol_normalizado ?: 'Usuario'),
        };
    }

    public function isCliente(): bool
    {
        return $this->rol_normalizado === 'cliente';
    }

    public function isStaff(): bool
    {
        return in_array($this->rol_normalizado, [
            'admin',
            'administrador',
            'vendedor',
            'auxiliar_bodega',
            'bodega',
            'auxiliar de bodega',
        ]);
    }

    public function isAdmin(): bool
    {
        return in_array($this->rol_normalizado, ['admin', 'administrador']);
    }

    public function isVendedor(): bool
    {
        return in_array($this->rol_normalizado, ['vendedor']);
    }

    public function isBodega(): bool
    {
        return in_array($this->rol_normalizado, [
            'auxiliar_bodega',
            'bodega',
            'auxiliar de bodega',
        ]);
    }
}
