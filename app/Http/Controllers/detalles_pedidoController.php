<?php

namespace App\Http\Controllers;

use App\Models\detallesPedido;
use App\Models\carritoCompra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


// Controlador encargado de gestionar los detalles del pedido y el proceso de pago
class detalles_pedidoController extends Controller
{
    // Muestra la vista para introducir los detalles de pago, recibiendo el precio total
    public function mostrarDetallesPago()
    {
        // Calcula el total real basandose en los productos que tiene el usuario en la BD
        $id_user = Auth::id();

        // Esta consulta suma (precio * cantidad) de todos los items del carrito del usuario
        $precioTotal = DB::table('carrito_compras')
            ->join('productos', 'carrito_compras.id_producto', '=', 'productos.id')
            ->where('carrito_compras.id_user', $id_user)
            ->sum(DB::raw('productos.precio * carrito_compras.cantidad'));

        // Si el carrito está vacío, lo devolvemos al inicio o al carrito
        if ($precioTotal <= 0) {
            return redirect('/carritoCompra')->with('error', 'Tu carrito está vacío');
        }

        return view('detalles_pedidos')->with('precioTotal', $precioTotal);

    }

    // Guarda los detalles del pedido y realiza el proceso de validación y descuento de saldo
    public function guardarDetallesPedido(Request $request)
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
        $user = Auth::user();

       // Recalcula el precio total en el servidor
       $precioTotal = DB::table('carrito_compras')
        ->join('productos', 'carrito_compras.id_producto', '=', 'productos.id')
        ->where('carrito_compras.id_user', $user->id)
        ->sum(DB::raw('productos.precio * carrito_compras.cantidad'));

        // Verificar saldo suficiente
        if ($user->saldo < $precioTotal) {
            return view('error_saldo');
        }

        // Intentamos hacer todo el bloque, si algo falla, se revierten todos los cambios (el dinero vuelve al usuario)
        try {
            DB::transaction(function () use ($request, $user, $precioTotal) {

                $user->decrement('saldo', $precioTotal);

                $detalles_pedido = new detallesPedido();
                $detalles_pedido->id_user = $user->id;
                $detalles_pedido->precio_total = $precioTotal;
                $detalles_pedido->pais = $request->input('pais');
                $detalles_pedido->ciudad = $request->input('ciudad');
                $detalles_pedido->direccion = $request->input('direccion');
                $detalles_pedido->save();

                // Vaciar el carrito
                carritoCompra::where('id_user', $user->id)->delete();
            });

            // Si llegamos hasta aquí, la transacción fue exitosa
            return view('agradecimiento');

        } catch (\Exception $e) {
            // Si algo falló, capturamos el error
            // El saldo no se habrá descontado gracias al DB::transaction
            return back()->with('error', 'Ocurrió un error al procesar el pedido. Intentalo de nuevo.' . $e->getMessage());
        }

    }
}