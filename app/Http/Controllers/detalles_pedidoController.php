<?php


// Definimos el espacio de nombres para los controladores de la aplicación
namespace App\Http\Controllers;


// Importamos los modelos necesarios y la clase Request
use App\Models\detallesPedido;
use App\Models\User;
use Illuminate\Http\Request;


// Controlador encargado de gestionar los detalles del pedido y el proceso de pago
class detalles_pedidoController extends Controller
{
    // Muestra la vista para introducir los detalles de pago, recibiendo el precio total
    public function mostrarDetallesPago($precioTotal)
    {
        return view('detalles_pedidos')->with('precioTotal', $precioTotal);
    }

    // Guarda los detalles del pedido y realiza el proceso de validación y descuento de saldo
    public function guardarDetallesPedido(Request $request, $precioTotal)
    {
        // Valida los datos del formulario de detalles del pedido
        $request->validate([
            'nombre' => 'required|string|max:100',
            'direccion' => 'required|string|max:255',
            'pais' => 'required|string|max:100',
            'ciudad' => 'required|string|max:100'
        ], [
            'nombre.required' => 'El nombre es obligatorio',
            'direccion.required' => 'La dirección es obligatoria.',
            'pais.required' => 'El país es obligatorio.',
            'ciudad.required' => 'La ciudad es obligatoria.'
        ]);

        // Obtiene el usuario autenticado
        $id = auth()->user()->id;
        $usuario = User::find($id);

        // Verifica si el usuario tiene saldo suficiente
        if ($usuario->saldo <= $precioTotal) {
            return view('error_saldo');
        }

        // Descuenta el precio total del saldo del usuario
        $usuario->saldo = $usuario->saldo - $precioTotal;
        $usuario->save();

        // Crea un nuevo registro de detalles del pedido
        $detalles_pedido = new detallesPedido();

        // Asigna el id del usuario y el precio total
        $id_user = auth()->user()->id;
        $detalles_pedido->id_user = $id_user;
        $detalles_pedido->precio_total = $precioTotal;

        // Asigna los datos de país, ciudad y dirección desde el formulario
        $pais = $request->input('pais');
        $detalles_pedido->pais = $pais;

        $ciudad = $request->input('ciudad');
        $detalles_pedido->ciudad = $ciudad;

        $direccion = $request->input('direccion');
        $detalles_pedido->direccion = $direccion;

        // Guarda los detalles del pedido en la base de datos
        $detalles_pedido->save();

        // Elimina todos los productos del carrito del usuario
        \App\Models\carritoCompra::where('id_user', auth()->user()->id)->delete();

        // Muestra la vista de agradecimiento
        return view('agradecimiento');
    }
}