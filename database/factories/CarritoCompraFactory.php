<?php


// Definimos el espacio de nombres para las fábricas de modelos de la base de datos
namespace Database\Factories;


// Importamos la clase base Factory de Eloquent
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * Fábrica para el modelo CarritoCompra.
 *
 * Permite generar datos de prueba (fake) para la tabla carrito_compras en la base de datos.
 * Utilizada principalmente en pruebas y seeders.
 *
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\carritoCompra>
 */
class CarritoCompraFactory extends Factory
{
    /**
     * Define el estado por defecto del modelo CarritoCompra.
     * Aquí puedes especificar los valores fake para cada campo del modelo.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            // Aquí puedes definir los campos fake, por ejemplo:
            // 'id_user' => fake()->numberBetween(1, 10),
            // 'cantidad' => fake()->numberBetween(1, 5),
            // 'id_producto' => fake()->numberBetween(1, 20),
        ];
    }
}
