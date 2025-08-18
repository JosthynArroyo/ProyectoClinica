<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserRole
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Si no se pasan roles, se permite el acceso
        if (empty($roles)) {
            return $next($request);
        }

        // Si no está autenticado, redirigir a login
        if (!$request->user()) {
            return redirect('/login');
        }

        // Verificar si el usuario tiene alguno de los roles requeridos
        foreach ($roles as $role) {
            // Aquí asumes que $request->user()->roles es colección de Role models
            if ($request->user()->roles->contains('name', $role)) {
                return $next($request);
            }
        }

        // Si no tiene roles permitidos, redirigir con error
        return redirect('/')->with('error', 'Acceso denegado');
    }
}
