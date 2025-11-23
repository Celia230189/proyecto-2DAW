<?php

namespace App\Http\Middleware;

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
