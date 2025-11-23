<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


// Middleware que redirige a los usuarios autenticados a la página principal si intentan acceder a rutas de invitados
class RedirectIfAuthenticated
{
    /**
     * Maneja la solicitud entrante.
     * Si el usuario ya está autenticado, lo redirige a la página principal.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        // Si no se especifican guards, se usa el guard por defecto
        $guards = empty($guards) ? [null] : $guards;

        // Recorre los guards y verifica si el usuario está autenticado en alguno
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // Si está autenticado, redirige a la página principal
                return redirect(RouteServiceProvider::HOME);
            }
        }

        // Si no está autenticado, permite continuar con la solicitud
        return $next($request);
    }
}
