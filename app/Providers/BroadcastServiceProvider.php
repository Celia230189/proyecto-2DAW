<?php


// Definimos el espacio de nombres para los proveedores de servicios de la aplicación
namespace App\Providers;


// Importamos el facade Broadcast y el ServiceProvider base
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\ServiceProvider;


// Proveedor de servicios para la transmisión de eventos (broadcasting)
class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Inicializa los servicios de broadcasting de la aplicación.
     * Registra las rutas necesarias y carga los canales definidos.
     *
     * @return void
     */
    public function boot()
    {
        // Registra las rutas para broadcasting (websockets, etc.)
        Broadcast::routes();

        // Carga la definición de los canales de broadcasting
        require base_path('routes/channels.php');
    }
}
