<?php


// Definimos el espacio de nombres para los middlewares de la aplicación
namespace App\Http\Middleware;


// Importamos Closure y la clase Request de Laravel
use Closure;
use Illuminate\Http\Request;


// Middleware para restringir el acceso solo a usuarios administradores
class Admin
{
    // Maneja la solicitud entrante y verifica si el usuario es administrador
    public function handle(Request $request, Closure $next)
    {
        // Si el usuario no está autenticado, lo redirige al login
        if (!auth()->check()) {
            return redirect('/login');
        }

        // Si el usuario autenticado no es administrador, lo redirige a inicio con mensaje de error
        if (auth()->user()->tipo_usuario != "1") {
            return redirect('/')->with('error', 'No tienes permiso para acceder aquí.');
        }

        // Permite continuar con la solicitud
        return $next($request);
    }
}
