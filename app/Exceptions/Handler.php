<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * Lista de tipos de excepciones con sus correspondientes niveles de log personalizados.
     * Puedes especificar aquí diferentes niveles de log para distintos tipos de excepciones.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [

    ];

    /**
     * Lista de tipos de excepciones que no serán reportadas.
     * Útil para evitar reportar ciertas excepciones que no requieren atención.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [

    ];

    /**
     * Lista de campos de entrada que nunca se mostrarán en la sesión cuando ocurra una excepción de validación.
     * Esto ayuda a proteger información sensible como contraseñas.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password', 
        'password_confirmation', 
    ];

    /**
     * Registra los callbacks para el manejo de excepciones en la aplicación.
     * Aquí puedes definir lógica personalizada para el reporte de excepciones.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {

        });
    }
}
