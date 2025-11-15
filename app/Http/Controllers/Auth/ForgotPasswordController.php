<?php


// Definimos el espacio de nombres para los controladores de autenticación
namespace App\Http\Controllers\Auth;


// Importamos el controlador base y el trait para enviar correos de restablecimiento de contraseña
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;


// Controlador encargado de gestionar el envío de correos para restablecer la contraseña
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

    // Incluimos el trait que proporciona la funcionalidad de envío de correos de restablecimiento
    use SendsPasswordResetEmails;
}
