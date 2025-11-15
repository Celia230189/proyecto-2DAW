<?php


// Definimos el espacio de nombres para los controladores de autenticación
namespace App\Http\Controllers\Auth;


// Importamos el controlador base, el proveedor de rutas y el trait para restablecimiento de contraseñas
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;


// Controlador encargado de gestionar las solicitudes de restablecimiento de contraseña
class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Controlador de Restablecimiento de Contraseña
    |--------------------------------------------------------------------------
    |
    | Este controlador se encarga de gestionar las solicitudes para restablecer
    | la contraseña y utiliza un trait que implementa este comportamiento. Puedes
    | explorar y sobreescribir cualquier método si necesitas personalización.
    |
    */

    // Incluimos el trait que proporciona la funcionalidad de restablecimiento de contraseñas
    use ResetsPasswords;

    /**
     * Ruta a la que se redirige a los usuarios después de restablecer su contraseña.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
}
