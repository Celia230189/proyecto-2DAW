<?php


// Definimos el espacio de nombres para los controladores de la aplicación
namespace App\Http\Controllers;


// Importamos la clase Request de Laravel
use Illuminate\Http\Request;


// Controlador encargado de la página principal (dashboard) de la aplicación
class HomeController extends Controller
{
    /**
     * Crea una nueva instancia del controlador.
     * Aplica el middleware 'auth' para que solo usuarios autenticados puedan acceder.
     *
     * @return void
     */
    public function __construct()
    {
        // Aplica el middleware de autenticación
        $this->middleware('auth');
    }

    /**
     * Muestra el dashboard principal de la aplicación.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Retorna la vista 'home' para el usuario autenticado
        return view('home');
    }
}
