<?php


// Definimos el espacio de nombres para las políticas de autorización de la aplicación
namespace App\Policies;


// Importamos los modelos necesarios y el trait para manejar la autorización
use App\Models\User;
use App\Models\carritoCompra;
use Illuminate\Auth\Access\HandlesAuthorization;


// Política de autorización para el modelo carritoCompra
class CarritoCompraPolicy
{
    // Incluye el trait para manejar la autorización
    use HandlesAuthorization;

    /**
     * Determina si el usuario puede ver cualquier modelo de carritoCompra.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        // Lógica para permitir o denegar ver todos los carritos
        return false;
    }

    /**
     * Determina si el usuario puede ver un carritoCompra específico.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\carritoCompra  $carritoCompra
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, carritoCompra $carritoCompra)
    {
        // Lógica para permitir o denegar ver un carrito específico
        return false;
    }

    /**
     * Determina si el usuario puede crear un carritoCompra.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        // Lógica para permitir o denegar la creación de un carrito
        return false;
    }

    /**
     * Determina si el usuario puede actualizar un carritoCompra.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\carritoCompra  $carritoCompra
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, carritoCompra $carritoCompra)
    {
        // Lógica para permitir o denegar la actualización de un carrito
        return false;
    }

    /**
     * Determina si el usuario puede eliminar un carritoCompra.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\carritoCompra  $carritoCompra
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, carritoCompra $carritoCompra)
    {
        // Lógica para permitir o denegar la eliminación de un carrito
        return false;
    }

    /**
     * Determina si el usuario puede restaurar un carritoCompra eliminado.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\carritoCompra  $carritoCompra
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, carritoCompra $carritoCompra)
    {
        // Lógica para permitir o denegar la restauración de un carrito
        return false;
    }

    /**
     * Determina si el usuario puede eliminar permanentemente un carritoCompra.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\carritoCompra  $carritoCompra
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, carritoCompra $carritoCompra)
    {
        // Lógica para permitir o denegar la eliminación permanente de un carrito
        return false;
    }
}
