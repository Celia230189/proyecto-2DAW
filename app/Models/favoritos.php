<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class favoritos extends Model
{
    use HasFactory;

    // 1. DEFINICIÓN DE TABLA
    protected $table = 'favoritos';

    // 2. SEGURIDAD ($fillable)
    // Campos que permitimos guardar automáticamente
    protected $fillable = [
        'id_user',
        'id_producto'
    ];

    // 3. RELACIONES
    
    // Un favorito PERTENECE a un Usuario
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Un favorito PERTENECE a un Producto
    public function producto()
    {
        return $this->belongsTo(producto::class, 'id_producto');
    }
}