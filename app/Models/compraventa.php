<?php


// Definimos el espacio de nombres para los modelos de la aplicación
namespace App\Models;


// Importamos el trait HasFactory y la clase base Model de Eloquent
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


// Modelo Eloquent que representa la tabla 'compraventa' en la base de datos
class compraventa extends Model
{
    // Incluye el trait HasFactory para permitir el uso de factories en pruebas y seeders
    use HasFactory;
}
