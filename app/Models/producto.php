<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class producto extends Model
{
    use HasFactory;

    // 1. DEFINICIÓN DE TABLA
    protected $table = 'productos';

    // 2. SEGURIDAD ($fillable)
    protected $fillable = [
        'titulo',
        'descripcion',
        'precio',
        'genero',           
        'tipo',             
        'categoria_prenda', 
        'valoracion',
        'imagen',           
        'img2',
        'img3',
        'img4'
    ];

    // 3. RELACIONES
    // Un producto puede estar en muchos carritos a la vez
    public function enCarritos()
    {
        return $this->hasMany(carritoCompra::class, 'id_producto');
    }

    // Un producto puede estar en muchas listas de favoritos
    public function enFavoritos()
    {
        return $this->hasMany(favoritos::class, 'id_producto');
    }

}