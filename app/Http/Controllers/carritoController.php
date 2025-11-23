<?php

namespace App\Http\Controllers;

use App\Models\carritoCompra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class carritoController extends Controller
{
    // Guarda un producto en el carrito
    public function guardarProductoCarrito(Request $request)
    {
        // Validamos un poco por seguridad
        $request->validate([
            'id_producto' => 'required|exists:productos,id'
        ]);

        // Buscamos si ya existe ese producto en el carrito de este usuario
        $carritoExistente = carritoCompra::where('id_user', Auth::id())
                                         ->where('id_producto', $request->id_producto)
                                         ->first();

        if ($carritoExistente) {
            // Si ya existe, sumamos 1 a la cantidad en vez de crear fila nueva
            $carritoExistente->cantidad += 1;
            $carritoExistente->save();
        } else {
            // Si no existe, creamos uno nuevo
            $carrito = new carritoCompra();
            $carrito->id_producto = $request->id_producto;
            $carrito->id_user = Auth::id();
            $carrito->cantidad = 1; // Asumimos 1 por defecto
            $carrito->save();
        }

        return redirect('/');
    }

    public function mostrarProductoCarrito()
    {
        // 1. OBTENER CARRITO CON ELOQUENT
        // Trae los items del carrito de este usuario Y TAMBIÉN (with) la info del producto asociado
        $carrito = carritoCompra::with('producto')
                    ->where('id_user', Auth::id())
                    ->get();

        // 2. CALCULAR EL TOTAL
        // Usamos las colecciones de Laravel para sumar en memoria
        $precioTotal = $carrito->sum(function($item) {
            return $item->producto->precio * $item->cantidad;
        });

        // Retornamos la vista pasando los objetos limpios
        return view('carritoCompra')
                ->with('datosCarrito', $carrito)
                ->with('precioTotal', $precioTotal);
    }

    // Actualiza cantidad
    public function actualizarCantidad(Request $request, $id)
    {
        $articulo = carritoCompra::find($id);
        
        // Seguridad: Verificar que el carrito es del usuario
        if ($articulo && $articulo->id_user == Auth::id()) {
            $cantidad = $request->input('cantidad' . $articulo->id);
            
            if ($cantidad > 0) {
                $articulo->cantidad = $cantidad;
                $articulo->save();
            } else {
                $articulo->delete(); // Si pone 0, lo borramos
            }
        }

        return redirect('/carritoCompra');
    }

    // Elimina producto
    public function eliminarProdCarrito(Request $request)
    {
        $id = (int) $request->input('id_borrar');
        $articulo = carritoCompra::find($id);

        // Seguridad: Solo borras si es tuyo
        if ($articulo && $articulo->id_user == Auth::id()) {
            $articulo->delete();
        }

        return redirect('/carritoCompra');
    }
}