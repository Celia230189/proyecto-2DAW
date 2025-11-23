<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;

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
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }
}
