<?php


// Definimos el espacio de nombres para las solicitudes personalizadas de la aplicación
namespace App\Http\Requests;


// Importamos la clase base para solicitudes de formulario de Laravel
use Illuminate\Foundation\Http\FormRequest;


// Clase de solicitud personalizada para validar la creación de un carrito de compra
class StorecarritoCompraRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para realizar esta solicitud.
     * Cambia a 'true' si quieres permitir la autorización por defecto.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Obtiene las reglas de validación que se aplican a la solicitud.
     * Aquí puedes definir las reglas para los campos del formulario.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
