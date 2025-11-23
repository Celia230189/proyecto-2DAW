<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance as Middleware;


// Middleware que impide el acceso a la aplicación cuando está en modo mantenimiento
class PreventRequestsDuringMaintenance extends Middleware
{
    /**
     * URIs que deben ser accesibles incluso cuando la aplicación está en modo mantenimiento.
     * Si necesitas que alguna ruta siga disponible, agrégala a este arreglo.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
    ];
}
