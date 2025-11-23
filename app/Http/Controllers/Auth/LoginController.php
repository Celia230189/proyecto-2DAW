<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Controlador de Inicio de Sesión
    |--------------------------------------------------------------------------
    |
    | Este controlador gestiona la autenticación de los usuarios en la aplicación
    | y los redirige a la pantalla principal. Utiliza un trait para proporcionar
    | fácilmente esta funcionalidad a tu aplicación.
    |
    */
    use AuthenticatesUsers;

    /**
     * Ruta a la que se redirige a los usuarios después de iniciar sesión.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Crea una nueva instancia del controlador.
     * Aplica el middleware 'guest' para que solo los usuarios no autenticados puedan acceder,
     * excepto para el método 'logout'.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
