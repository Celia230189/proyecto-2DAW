<?php


// Definimos el espacio de nombres para los controladores de la aplicación
namespace App\Http\Controllers;


// Importamos el modelo carritoCompra, la clase Request y el facade DB para consultas directas
use App\Models\carritoCompra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


// Controlador encargado de gestionar el carrito de compras
class carritoController extends Controller
{
    // Guarda un producto en el carrito del usuario autenticado
    public function guardarProductoCarrito(Request $request)
    {
        $carrito = new carritoCompra();

        // Obtiene el id del producto desde la solicitud y lo asigna al carrito
        $id_producto = $request->id_producto;
        $carrito->id_producto = $id_producto;

        // Obtiene el id del usuario autenticado y lo asigna al carrito
        $id_user = auth()->user()->id;
        $carrito->id_user = $id_user;

        // Guarda el registro en la base de datos
        $carrito->save();

        // Redirige a la página principal
        return redirect('/');
    }

    // Muestra los productos del carrito del usuario autenticado y el precio total
    public function mostrarProductoCarrito()
    {
        // Consulta los productos del carrito y sus detalles mediante SQL directo
        $carrito = DB::select('SELECT carrito_compras.id,productos.imagen, productos.titulo, productos.precio, productos.descripcion, carrito_compras.cantidad FROM carrito_compras JOIN productos ON carrito_compras.id_producto = productos.id JOIN users ON carrito_compras.id_user= users.id  WHERE carrito_compras.id_user =' . auth()->user()->id . '');

        // Calcula el precio total del carrito
        $precioTotal = DB::select('SELECT SUM((productos.precio*carrito_compras.cantidad)) AS total FROM carrito_compras JOIN productos ON carrito_compras.id_producto = productos.id JOIN users ON carrito_compras.id_user= users.id  WHERE carrito_compras.id_user =' . auth()->user()->id . '');

        // Retorna la vista con los datos del carrito y el precio total
        return view('carritoCompra')->with('datosCarrito', $carrito)->with('precioTotal', $precioTotal);
    }

    // Actualiza la cantidad de un producto en el carrito
    public function actualizarCantidad(Request $request, $id)
    {
        $articulo = carritoCompra::find($id);

        // Obtiene la nueva cantidad desde el formulario y la asigna
        $cantidad = $request->input('cantidad' . $articulo->id);
        $articulo->cantidad = $cantidad;

        // Guarda los cambios en la base de datos
        $articulo->save();

        // Redirige a la vista del carrito
        return redirect('/carritoCompra');
    }

    // Elimina un producto del carrito
    public function eliminarProdCarrito(Request $request)
    {
        $id = (int) $request->input('id_borrar');

        // Busca el producto en el carrito y lo elimina
        $articulo = carritoCompra::find($id);
        $articulo->delete();

        // Redirige a la vista del carrito
        return redirect('/carritoCompra');
    }
}