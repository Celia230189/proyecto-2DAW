<?php


// Definimos el espacio de nombres para los controladores de la aplicación
namespace App\Http\Controllers;


// Importamos traits y la clase base necesarios para los controladores
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;


// Controlador base del que heredan todos los demás controladores de la aplicación
class Controller extends BaseController
{
    // Incluye los traits para autorización, despacho de trabajos y validación de solicitudes
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
