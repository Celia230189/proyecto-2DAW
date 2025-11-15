<?php


// Definimos el espacio de nombres para los controladores de autenticación
namespace App\Http\Controllers\Auth;


// Importamos el controlador base, el proveedor de rutas y el trait para confirmar contraseñas
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ConfirmsPasswords;


// Controlador encargado de gestionar la confirmación de contraseñas
class ConfirmPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Controlador de Confirmación de Contraseña
    |--------------------------------------------------------------------------
    |
    | Este controlador se encarga de gestionar la confirmación de contraseñas
    | y utiliza un trait que implementa el comportamiento necesario. Puedes
    | explorar y sobreescribir cualquier función si necesitas personalización.
    |
    */

    // Incluimos el trait que proporciona la funcionalidad de confirmación de contraseñas
    use ConfirmsPasswords;

    /**
     * Ruta a la que se redirige al usuario cuando la URL deseada falla.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Crea una nueva instancia del controlador.
     * Aplica el middleware 'auth' para asegurar que solo usuarios autenticados puedan acceder.
     *
     * @return void
     */
    public function __construct()
    {
        // Aplica el middleware de autenticación
        $this->middleware('auth');
    }
}
