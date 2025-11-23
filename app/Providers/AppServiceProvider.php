<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Models\carritoCompra;
use App\Models\favoritos;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Compartir contadores de carrito y favoritos en TODAS las vistas ('*')
        View::composer('*', function ($view) {
            $carritoCount = 0;
            $favCount = 0;

            // Solo calculamos si hay alguien logueado
            if (Auth::check()) {
                $userId = Auth::id();

                // 1. CONTADOR CARRITO
                // Usamos el modelo para sumar la columna 'cantidad' de todos los items
                $carritoCount = carritoCompra::where('id_user', $userId)->sum('cantidad');

                // 2. CONTADOR FAVORITOS
                // Usamos el modelo para contar cuántas filas tiene
                $favCount = favoritos::where('id_user', $userId)->count();
            }

            // Enviamos las variables a todas las vistas
            $view->with('carritoCount', $carritoCount)
                 ->with('favCount', $favCount);
        });
    }
}