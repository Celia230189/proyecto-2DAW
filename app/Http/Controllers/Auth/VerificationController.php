<?php


// Definimos el espacio de nombres para los controladores de autenticación
namespace App\Http\Controllers\Auth;


// Importamos el controlador base, el proveedor de rutas y el trait para verificación de emails
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;


// Controlador encargado de gestionar la verificación de correos electrónicos
class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Controlador de Verificación de Email
    |--------------------------------------------------------------------------
    |
    | Este controlador se encarga de gestionar la verificación de correo electrónico
    | para cualquier usuario que se haya registrado recientemente en la aplicación.
    | También permite reenviar el correo si el usuario no lo recibió.
    |
    */

    // Incluimos el trait que proporciona la funcionalidad de verificación de emails
    use VerifiesEmails;

    /**
     * Ruta a la que se redirige a los usuarios después de la verificación.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Crea una nueva instancia del controlador.
     * Aplica varios middlewares para proteger las rutas de verificación.
     *
     * @return void
     */
    public function __construct()
    {
        // Requiere que el usuario esté autenticado
        $this->middleware('auth');
        // Requiere que la URL esté firmada para la verificación
        $this->middleware('signed')->only('verify');
        // Limita la cantidad de intentos de verificación y reenvío a 6 por minuto
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }
}
