<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class carritoCompra extends Model
{
    use HasFactory;

    // Definimos la tabla explícitamente
    protected $table = 'carrito_compras';

    // Campos que permitimos rellenar masivamente
    protected $fillable = ['id_user', 'id_producto', 'cantidad'];

    // --- RELACIONES ---

    // Un ítem del carrito PERTENECE a un Usuario
    public function usuario()
    {
        // 'id_user' columna clave foránea
        return $this->belongsTo(User::class, 'id_user');
    }

    // Un ítem del carrito PERTENECE a un Producto
    public function producto()
    {
        // 'id_producto' columna clave foránea
        return $this->belongsTo(producto::class, 'id_producto');
    }
}