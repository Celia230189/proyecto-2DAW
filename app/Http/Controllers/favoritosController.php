<?php

namespace App\Http\Controllers;

use App\Models\favoritos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class favoritosController extends Controller
{
    // Muestra los productos favoritos
    public function mostrarFavoritos()
    {
        // Obtiene el id del usuario actualmente logueado
        $id_user = Auth::id();
        
        // Hacemos un JOIN para traer los datos del producto (título, precio, imagen) usando el id guardado.
        $favoritos = DB::select('
            SELECT favoritos.id, productos.titulo, productos.precio, productos.descripcion, productos.imagen 
            FROM favoritos 
            JOIN productos ON favoritos.id_producto = productos.id 
            JOIN users ON favoritos.id_user = users.id 
            WHERE favoritos.id_user = ?', [$id_user]);

        // Envía los datos a la vista 'favoritos.blade.php'  
        return view('favoritos')->with('datosFavoritos', $favoritos);
    }

    // Añade un producto
    public function añadirFavorito(Request $request)
    {
        $favorito = new favoritos();

        $favorito->id_producto = $request->id_producto;
        $favorito->id_user = Auth::id();

        $favorito->save();

        return back(); 
    }

    // Elimina un producto
    public function eliminarFavorito(Request $request)
    {
        $id = (int) $request->input('id_borrar');

        // Buscamos el favorito
        $articulo = favoritos::find($id);

        // Verificamos si existe Y si pertenece al usuario conectado.
        if ($articulo && $articulo->id_user == Auth::id()) {
            $articulo->delete();
        } else {
            // Opcional: Podrías lanzar un error 403 o simplemente ignorarlo
            return back()->with('error', 'No puedes eliminar este favorito.');
        }

        return redirect('/favoritos');
    }
}