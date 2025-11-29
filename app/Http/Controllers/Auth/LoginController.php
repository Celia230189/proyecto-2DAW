<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     * Obtener el mensaje de error de credenciales fallidas.
     *
     * @return string
     */
    protected function sendFailedLoginResponse(\Illuminate\Http\Request $request)
    {
        throw \Illuminate\Validation\ValidationException::withMessages([
            $this->username() => ['Usuario o contraseña incorrectos.'],
        ]);
    }

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

    /**
     * Cerrar sesión del usuario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::guard()->logout();
        
        $request->session()->invalidate();
        
        $request->session()->regenerateToken();
        
        return redirect('/')->with('success', 'Has cerrado sesión correctamente');
    }
}
