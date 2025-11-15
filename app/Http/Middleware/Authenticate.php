<?php


// Definimos el espacio de nombres para los middlewares de la aplicación
namespace App\Http\Middleware;


// Importamos el middleware base de autenticación de Laravel
use Illuminate\Auth\Middleware\Authenticate as Middleware;


// Middleware que gestiona la autenticación de usuarios
class Authenticate extends Middleware
{
    /**
     * Obtiene la ruta a la que se debe redirigir al usuario cuando no está autenticado.
     * Si la petición no espera una respuesta JSON, redirige a la ruta de login.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        // Si la petición no es para una API (no espera JSON), redirige al login
        if (! $request->expectsJson()) {
            return route('login');
        }
    }
}