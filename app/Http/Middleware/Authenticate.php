<?php

namespace App\Http\Middleware;

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