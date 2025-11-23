<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

// Kernel principal que gestiona los middlewares globales, de grupo y de ruta
class Kernel extends HttpKernel
{
    /**
     * Pila de middlewares HTTP globales de la aplicación.
     * Estos middlewares se ejecutan en cada petición a la aplicación.
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [
        // Middleware para confiar en los hosts (comentado por defecto)
        // \App\Http\Middleware\TrustHosts::class,
        // Middleware para confiar en proxies
        \App\Http\Middleware\TrustProxies::class,
        // Middleware para gestionar CORS
        \Illuminate\Http\Middleware\HandleCors::class,
        // Middleware para bloquear peticiones durante el mantenimiento
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        // Middleware para validar el tamaño de las peticiones POST
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        // Middleware para recortar los strings de las solicitudes
        \App\Http\Middleware\TrimStrings::class,
        // Middleware para convertir cadenas vacías en null
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * Grupos de middlewares de rutas de la aplicación.
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        'web' => [
            // Middlewares para el grupo web
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            // Middlewares para el grupo api
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * Middlewares de ruta de la aplicación.
     * Estos middlewares pueden asignarse a grupos o usarse individualmente.
     *
     * @var array<string, class-string|string>
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class, // Autenticación de usuarios
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class, // Autenticación básica HTTP
        'auth.session' => \Illuminate\Session\Middleware\AuthenticateSession::class, // Sesión de autenticación
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class, // Cabeceras de caché
        'can' => \Illuminate\Auth\Middleware\Authorize::class, // Autorización de acciones
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class, // Redirección si ya está autenticado
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class, // Confirmación de contraseña
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class, // Validación de firmas en rutas
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class, // Limitación de peticiones
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class, // Verificación de email
        'admin' => \App\Http\Middleware\Admin::class, // Middleware personalizado para administradores
        'compraventa' => \App\Http\Middleware\Compraventa::class, // Middleware personalizado para compraventa
    ];
}
