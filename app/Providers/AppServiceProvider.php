<?php


// Definimos el espacio de nombres para los proveedores de servicios de la aplicación
namespace App\Providers;


// Importamos los proveedores y facades necesarios
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;


// Proveedor de servicios principal de la aplicación
class AppServiceProvider extends ServiceProvider
{
    /**
     * Registra cualquier servicio de la aplicación.
     * Aquí puedes enlazar servicios personalizados en el contenedor de Laravel.
     *
     * @return void
     */
    public function register()
    {
        // Puedes registrar servicios personalizados aquí
    }

    /**
     * Inicializa cualquier servicio de la aplicación.
     * Aquí se comparten los contadores de carrito y favoritos con todas las vistas.
     *
     * @return void
     */
    public function boot()
    {
        // Compartir contadores de carrito y favoritos en todas las vistas
        View::composer('*', function ($view) {
            $carritoCount = 0; // Inicializa el contador de carrito
            $favCount = 0;     // Inicializa el contador de favoritos

            // Si el usuario está autenticado
            if (Auth::check()) {
                $userId = Auth::id();

                // Suma la cantidad total de productos en el carrito
                $carritoCount = (int) DB::table('carrito_compras')
                    ->where('id_user', $userId)
                    ->sum('cantidad');

                // Si la suma es 0, cuenta el número de productos en el carrito
                if ($carritoCount === 0) {
                    $carritoCount = (int) DB::table('carrito_compras')
                        ->where('id_user', $userId)
                        ->count();
                }

                // Cuenta el número de productos en favoritos
                $favCount = (int) DB::table('favoritos')
                    ->where('id_user', $userId)
                    ->count();
            }

            // Comparte las variables con todas las vistas
            $view->with('carritoCount', $carritoCount)->with('favCount', $favCount);
        });
    }
}
