<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\TrimStrings as Middleware;


// Middleware que recorta (elimina espacios en blanco) de los strings en las solicitudes
class TrimStrings extends Middleware
{
    /**
     * Nombres de los atributos que no deben ser recortados.
     * Por ejemplo, las contraseñas no se recortan para evitar problemas de autenticación.
     *
     * @var array<int, string>
     */
    protected $except = [
        'current_password', 
        'password', 
        'password_confirmation', 
    ];
}
