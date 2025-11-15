<?php


// Definimos el espacio de nombres para los controladores de autenticación
namespace App\Http\Controllers\Auth;


// Importamos el controlador base, el proveedor de rutas, el modelo User,
// y las clases necesarias para el registro, hash y validación
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


// Controlador encargado de gestionar el registro de nuevos usuarios
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Controlador de Registro
    |--------------------------------------------------------------------------
    |
    | Este controlador gestiona el registro de nuevos usuarios, así como su
    | validación y creación. Por defecto, utiliza un trait para proporcionar
    | esta funcionalidad sin requerir código adicional.
    |
    */

    // Incluimos el trait que proporciona la funcionalidad de registro de usuarios
    use RegistersUsers;

    /**
     * Ruta a la que se redirige a los usuarios después del registro.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Crea una nueva instancia del controlador.
     * Aplica el middleware 'guest' para que solo los usuarios no autenticados puedan acceder.
     *
     * @return void
     */
    public function __construct()
    {
        // Aplica el middleware para invitados
        $this->middleware('guest');
    }

    /**
     * Obtiene un validador para una solicitud de registro entrante.
     * Define las reglas de validación para los datos del formulario de registro.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        // Valida que el nombre, email y contraseña cumplan los requisitos
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'], // El nombre es obligatorio, tipo string y máximo 255 caracteres
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'], // Email obligatorio, formato válido, único
            'password' => ['required', 'string', 'min:8', 'confirmed'], // Contraseña obligatoria, mínimo 8 caracteres, confirmada
        ]);
    }

    /**
     * Crea una nueva instancia de usuario después de un registro válido.
     * Guarda el usuario en la base de datos con los datos validados y la contraseña encriptada.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // Crea y retorna el nuevo usuario
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']), // Encripta la contraseña
        ]);
    }
}
