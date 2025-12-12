<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class compraventa extends Model
{
    use HasFactory;

    // 1. DEFINIR LA TABLA
    protected $table = 'compraventas'; 

    // 2. SEGURIDAD ($fillable)
    // Estos son los campos que permitimos guardar desde el formulario.
    protected $fillable = [
        'id_user',
        'nombre_producto',
        'descripcion_producto',
        'precio',
        'contacto',
        'imagen'
    ];

    // 3. RELACIONES
    
    // Un producto de segunda mano PERTENECE a un Usuario (el vendedor)
    public function usuario()
    {
        // 'id_user' es la columna que conecta con la tabla users
        return $this->belongsTo(User::class, 'id_user');
    }

}