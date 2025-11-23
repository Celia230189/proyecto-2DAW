<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Controlador de Restablecimiento de Contraseña
    |--------------------------------------------------------------------------
    |
    | Este controlador se encarga de enviar los correos electrónicos para
    | restablecer la contraseña. Utiliza un trait que facilita el envío de
    | estas notificaciones desde tu aplicación a los usuarios.
    |
    */

    use SendsPasswordResetEmails;
}
