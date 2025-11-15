<?php


// Definimos el espacio de nombres para los proveedores de servicios de la aplicación
namespace App\Providers;


// Importamos el proveedor base de autenticación y el facade Gate
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;


// Proveedor de servicios para la autenticación y autorización de la aplicación
class AuthServiceProvider extends ServiceProvider
{
    /**
     * Mapeo de modelos a policies para la aplicación.
     * Aquí puedes registrar qué policy corresponde a cada modelo.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Registra cualquier servicio de autenticación/autorización.
     * Aquí se registran las policies y se pueden definir gates personalizadas.
     *
     * @return void
     */
    public function boot()
    {
        // Registra las policies definidas en el arreglo anterior
        $this->registerPolicies();

        // Puedes definir gates personalizadas aquí si lo necesitas
        // Gate::define('nombre-gate', function ($user) { ... });
    }
}
