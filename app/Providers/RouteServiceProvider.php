<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

/**
 * Proveedor de servicios de rutas de la aplicación.
 *
 * Se encarga de definir la configuración de rutas, enlaces de modelos y limitadores de peticiones.
 */
class RouteServiceProvider extends ServiceProvider
{
    /**
     * Ruta a la que se redirige a los usuarios después de autenticarse.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Método principal para definir enlaces de modelos, filtros de patrones y otras configuraciones de rutas.
     *
     * @return void
     */
    public function boot()
    {
        // Configura los limitadores de peticiones para la aplicación
        $this->configureRateLimiting();

        // Define los grupos de rutas para la aplicación
        $this->routes(function () {
            // Grupo de rutas para la API, con prefijo 'api' y middleware 'api'
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            // Grupo de rutas web, con middleware 'web'
            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Configura los limitadores de velocidad (rate limiters) para la aplicación.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        // Define un limitador para la API: máximo 60 peticiones por minuto por usuario o IP
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
