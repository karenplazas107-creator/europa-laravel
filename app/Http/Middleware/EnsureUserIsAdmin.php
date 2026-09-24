<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Asegura que el usuario autenticado tenga rol de Administrador.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        if (! Auth::user()->isAdmin()) {
            if (Auth::user()->isCliente()) {
                return redirect()->route('tienda')
                    ->with('error', 'No tienes permisos para acceder al panel de administración.');
            }

            return redirect()->route('dashboard')
                ->with('error', 'Acceso restringido: Solo los Administradores pueden gestionar los usuarios del sistema.');
        }

        return $next($request);
    }
}
