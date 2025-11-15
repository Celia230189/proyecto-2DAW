<?php


// Definimos el espacio de nombres para los controladores de la aplicación
namespace App\Http\Controllers;


// Importamos el modelo favoritos, la clase Request y el facade DB para consultas directas
use App\Models\favoritos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


// Controlador encargado de gestionar la funcionalidad de favoritos
class favoritosController extends Controller
{
    // Muestra los productos favoritos del usuario autenticado
    public function mostrarFavoritos()
    {
        // Consulta los productos favoritos y sus detalles mediante SQL directo
        $favoritos = DB::select('SELECT favoritos.id, productos.titulo, productos.precio, productos.descripcion, productos.imagen FROM favoritos JOIN productos ON favoritos.id_producto = productos.id JOIN users ON favoritos.id_user= users.id WHERE favoritos.id_user =' . auth()->user()->id . '');

        // Retorna la vista con los datos de favoritos
        return view('favoritos')->with('datosFavoritos', $favoritos);
    }

    // Añade un producto a la lista de favoritos del usuario autenticado
    public function añadirFavorito(Request $request)
    {
        $carrito = new favoritos();

        // Obtiene el id del producto desde la solicitud y lo asigna
        $id_producto = $request->id_producto;
        $carrito->id_producto = $id_producto;

        // Obtiene el id del usuario autenticado y lo asigna
        $id_user = auth()->user()->id;
        $carrito->id_user = $id_user;

        // Guarda el registro en la base de datos
        $carrito->save();

        // Redirige a la página principal
        return redirect('/');
    }

    // Elimina un producto de la lista de favoritos
    public function eliminarFavorito(Request $request)
    {
        $id = (int) $request->input('id_borrar');

        // Busca el producto favorito y lo elimina
        $articulo = favoritos::find($id);
        $articulo->delete();

        // Redirige a la vista de favoritos
        return redirect('/favoritos');
    }
}