<?php


// Definimos el espacio de nombres para los proveedores de servicios de la aplicación
namespace App\Providers;


// Importamos eventos, listeners y el ServiceProvider base
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;


// Proveedor de servicios para la gestión de eventos y listeners de la aplicación
class EventServiceProvider extends ServiceProvider
{
    /**
     * Mapeo de eventos a listeners para la aplicación.
     * Aquí se define qué listener responde a cada evento.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        // Cuando un usuario se registra, se envía la notificación de verificación de email
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Registra cualquier evento para tu aplicación.
     * Puedes agregar lógica personalizada de registro de eventos aquí.
     *
     * @return void
     */
    public function boot()
    {
        // Puedes registrar eventos adicionales aquí si lo necesitas
    }

    /**
     * Determina si los eventos y listeners deben descubrirse automáticamente.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
