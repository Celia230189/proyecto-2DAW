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

    // 4. ACCESSORS - Asegura que las rutas de las imágenes siempre tengan el formato correcto
    public function getImagenAttribute($value)
    {
        if (empty($value)) {
            return 'img/productos/default.jpg';
        }
        return ltrim($value, '/');
    }

    public function getImg2Attribute($value)
    {
        if (empty($value)) {
            return 'img/productos/default.jpg';
        }
        return ltrim($value, '/');
    }

    public function getImg3Attribute($value)
    {
        if (empty($value)) {
            return 'img/productos/default.jpg';
        }
        return ltrim($value, '/');
    }

    public function getImg4Attribute($value)
    {
        if (empty($value)) {
            return 'img/productos/default.jpg';
        }
        return ltrim($value, '/');
    }
}