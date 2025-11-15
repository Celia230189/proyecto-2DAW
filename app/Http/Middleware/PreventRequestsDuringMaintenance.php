<?php


// Definimos el espacio de nombres para los middlewares de la aplicación
namespace App\Http\Middleware;


// Importamos el middleware base que gestiona el modo mantenimiento de Laravel
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
