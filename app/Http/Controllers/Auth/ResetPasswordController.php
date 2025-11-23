<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;

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

    use ResetsPasswords;

    /**
     * Ruta a la que se redirige a los usuarios después de restablecer su contraseña.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
}
