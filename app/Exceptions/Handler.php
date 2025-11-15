<?php


// Definimos el espacio de nombres para las excepciones de la aplicación
namespace App\Exceptions;


// Importamos la clase base para el manejo de excepciones y la interfaz Throwable
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;


// Clase Handler que gestiona el manejo global de excepciones en la aplicación
class Handler extends ExceptionHandler
{
    /**
     * Lista de tipos de excepciones con sus correspondientes niveles de log personalizados.
     * Puedes especificar aquí diferentes niveles de log para distintos tipos de excepciones.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        // Agrega aquí tipos de excepciones y sus niveles de log si es necesario
    ];

    /**
     * Lista de tipos de excepciones que no serán reportadas.
     * Útil para evitar reportar ciertas excepciones que no requieren atención.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        // Agrega aquí excepciones que no deseas reportar
    ];

    /**
     * Lista de campos de entrada que nunca se mostrarán en la sesión cuando ocurra una excepción de validación.
     * Esto ayuda a proteger información sensible como contraseñas.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password', // Contraseña actual
        'password', // Nueva contraseña
        'password_confirmation', // Confirmación de contraseña
    ];

    /**
     * Registra los callbacks para el manejo de excepciones en la aplicación.
     * Aquí puedes definir lógica personalizada para el reporte de excepciones.
     *
     * @return void
     */
    public function register()
    {
        // Callback para manejar el reporte de excepciones personalizadas
        $this->reportable(function (Throwable $e) {
            // Puedes agregar lógica personalizada para el reporte de excepciones aquí
        });
    }
}
