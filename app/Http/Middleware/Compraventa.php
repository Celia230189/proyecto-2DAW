<?php


// Definimos el espacio de nombres para los middlewares de la aplicación
namespace App\Http\Middleware;


// Importamos Closure y la clase Request de Laravel
use Closure;
use Illuminate\Http\Request;


// Middleware para restringir el acceso a la funcionalidad de compraventa solo a usuarios autenticados
class Compraventa
{
    // Maneja la solicitud entrante y verifica si el usuario está autenticado
    public function handle(Request $request, Closure $next)
    {
        // Si el usuario no está autenticado, lo redirige al login con un mensaje de error
        if (!auth()->check()) {
            return redirect('/login')->with('error', 'Debes iniciar sesión para acceder a compraventa.');
        }

        // Permite continuar con la solicitud
        return $next($request);
    }
}
