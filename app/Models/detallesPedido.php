<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


// Modelo Eloquent que representa la tabla 'detalles_pedidos' en la base de datos
class detallesPedido extends Model
{
    // Incluye el trait HasFactory para permitir el uso de factories en pruebas y seeders
    use HasFactory;

    // Especifica el nombre de la tabla asociada a este modelo
    protected $table = 'detalles_pedidos';

    // Define los campos que pueden ser asignados masivamente
    protected $fillable = [
        'id_user',         // ID del usuario que realiza el pedido
        'precio_total',    // Precio total del pedido
        'pais',            // País de envío
        'cuidad',          // Ciudad de envío (posible error tipográfico, debería ser 'ciudad')
        'direccion',       // Dirección de envío
    ];
}
