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
     * Indica a Laravel que el campo de autenticación es 'movil'
     * en lugar del 'email' por defecto.
     */
    public function getAuthIdentifierName(): string
    {
        return 'movil';
    }
}
