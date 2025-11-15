<?php


// Definimos el espacio de nombres para las políticas de autorización de la aplicación
namespace App\Policies;


// Importamos los modelos necesarios y el trait para manejar la autorización
use App\Models\User;
use App\Models\detallesCarritoCompra;
use Illuminate\Auth\Access\HandlesAuthorization;


// Política de autorización para el modelo detallesCarritoCompra
class DetallesCarritoCompraPolicy
{
    // Incluye el trait para manejar la autorización
    use HandlesAuthorization;

    /**
     * Determina si el usuario puede ver cualquier modelo de detallesCarritoCompra.
     */
    public function viewAny(User $user)
    {
        // Lógica para permitir o denegar ver todos los detalles
        return false;
    }

    /**
     * Determina si el usuario puede ver un detallesCarritoCompra específico.
     */
    public function view(User $user, detallesCarritoCompra $detallesCarritoCompra)
    {
        // Lógica para permitir o denegar ver un detalle específico
        return false;
    }

    /**
     * Determina si el usuario puede crear un detallesCarritoCompra.
     */
    public function create(User $user)
    {
        // Lógica para permitir o denegar la creación de un detalle
        return false;
    }

    /**
     * Determina si el usuario puede actualizar un detallesCarritoCompra.
     */
    public function update(User $user, detallesCarritoCompra $detallesCarritoCompra)
    {
        // Lógica para permitir o denegar la actualización de un detalle
        return false;
    }

    /**
     * Determina si el usuario puede eliminar un detallesCarritoCompra.
     */
    public function delete(User $user, detallesCarritoCompra $detallesCarritoCompra)
    {
        // Lógica para permitir o denegar la eliminación de un detalle
        return false;
    }

    /**
     * Determina si el usuario puede restaurar un detallesCarritoCompra eliminado.
     */
    public function restore(User $user, detallesCarritoCompra $detallesCarritoCompra)
    {
        // Lógica para permitir o denegar la restauración de un detalle
        return false;
    }

    /**
     * Determina si el usuario puede eliminar permanentemente un detallesCarritoCompra.
     */
    public function forceDelete(User $user, detallesCarritoCompra $detallesCarritoCompra)
    {
        // Lógica para permitir o denegar la eliminación permanente de un detalle
        return false;
    }
}
