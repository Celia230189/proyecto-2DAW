<?php


// Definimos el espacio de nombres para los middlewares de la aplicación
namespace App\Http\Middleware;


// Importamos el middleware base que recorta los strings de las solicitudes
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
        'current_password', // Contraseña actual
        'password', // Nueva contraseña
        'password_confirmation', // Confirmación de contraseña
    ];
}
