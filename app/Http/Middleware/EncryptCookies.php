<?php


// Definimos el espacio de nombres para los middlewares de la aplicación
namespace App\Http\Middleware;


// Importamos el middleware base para el cifrado de cookies de Laravel
use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;


// Middleware encargado de cifrar y descifrar automáticamente las cookies
class EncryptCookies extends Middleware
{
    /**
     * Nombres de las cookies que no deben ser cifradas.
     * Si necesitas que alguna cookie no se cifre, agrégala a este arreglo.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
    ];
}
