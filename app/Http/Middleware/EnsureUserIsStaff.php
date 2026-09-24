<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsStaff
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        // Si el usuario es un cliente, no puede acceder a las rutas de administración
        if (Auth::user()->isCliente()) {
            return redirect()->route('tienda')
                ->with('error', 'No tienes permisos para acceder al panel de administración.');
        }

        return $next($request);
    }
}
