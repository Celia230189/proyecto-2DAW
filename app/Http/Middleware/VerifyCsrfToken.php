<?php


// Definimos el espacio de nombres para los middlewares de la aplicación
namespace App\Http\Middleware;


// Importamos el middleware base que verifica el token CSRF de Laravel
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;


// Middleware encargado de verificar el token CSRF en las solicitudes
class VerifyCsrfToken extends Middleware
{
    /**
     * URIs que deben ser excluidas de la verificación CSRF.
     * Si necesitas que alguna ruta no requiera token CSRF, agrégala a este arreglo.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
    ];
}
