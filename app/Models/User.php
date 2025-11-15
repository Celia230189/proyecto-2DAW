<?php


// Definimos el espacio de nombres para los modelos de la aplicación
namespace App\Models;


// Importamos interfaces y traits necesarios para el modelo de usuario
use Illuminate\Contracts\Auth\MustVerifyEmail;
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
        'name',         // Nombre del usuario
        'email',        // Correo electrónico
        'password',     // Contraseña
        'tipo_usuario'  // Tipo de usuario (por ejemplo, admin o cliente)
    ];

    /**
     * Atributos que deben ocultarse al serializar el modelo.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',         // Contraseña
        'remember_token',   // Token de sesión
    ];

    /**
     * Atributos que deben ser convertidos a tipos nativos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime', // Fecha de verificación de email
    ];
}
