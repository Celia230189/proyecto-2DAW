<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


// Modelo Eloquent que representa la tabla 'users' en la base de datos
class User extends Authenticatable
{
    // Incluye traits para API tokens, factories y notificaciones
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Atributos que pueden ser asignados masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',         
        'email',       
        'password',     
        'tipo_usuario' 
    ];

    /**
     * Atributos que deben ocultarse al serializar el modelo.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',       
        'remember_token',   
    ];

}
