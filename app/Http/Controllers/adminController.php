<?php


// Definimos el espacio de nombres para los controladores de la aplicación
namespace App\Http\Controllers;


// Importamos el controlador base, el modelo producto y la clase Request
use App\Http\Controllers\Controller;
use App\Models\producto;
use Illuminate\Http\Request;


// Controlador encargado de la administración de productos
class adminController extends Controller
{
    // ----- MOSTRAR PRODUCTOS -----

    // --- Mostrar todos los productos ---
    // Recupera todos los productos de la base de datos y los pasa a la vista de administración
    public function mostrarProductos()
    {
        $listaProductos = producto::all();
        return view('administrar/administrar', ['datosProductos' => $listaProductos]);
    }
    // ----- FIN MOSTRAR PRODUCTOS -----

    // ----- AÑADIR PRODUCTO -----
    // Muestra el formulario para añadir un nuevo producto
    public function menuNuevo()
    {
        return view('administrar/nuevoProd');
    }

    // Procesa la solicitud para crear un nuevo producto y lo guarda en la base de datos
    public function nuevoProd(Request $request)
    {
        $producto = new producto;

        // Asigna los valores recibidos del formulario a las propiedades del producto
        $titulo = $request->titulo;
        $producto->titulo = $titulo;

        $descripcion = $request->descripcion;
        $producto->descripcion = $descripcion;

        $tipo = $request->tipo;
        $producto->tipo = $tipo;

        $marca = $request->marca;
        $producto->marca = $marca;

        $genero = $request->genero;
        $producto->genero = $genero;

        $categoria_prenda = $request->categoria_prenda;
        $producto->categoria_prenda = $categoria_prenda;

        $precio = $request->precio;
        $producto->precio = $precio;

        $valoracion = $request->valoracion;
        $producto->valoracion = $valoracion;

        // Guarda el producto en la base de datos
        $producto->save();

        // Redirige a la vista de administración
        return redirect('/administrar');
    }
    // ----- FIN AÑADIR PRODUCTO -----

    // ----- BORRAR PRODUCTO -----
    // Elimina un producto y sus imágenes asociadas
    public function borrar($id)
    {
        $producto = producto::find($id);
        $producto->delete();

        // Elimina la imagen principal si existe
        $ruta_img = public_path($producto->imagen);
        if ($ruta_img) {
            unlink($ruta_img);
        }

        // Elimina la imagen secundaria 2 si existe
        $ruta_img2 = public_path($producto->img2);
        if ($ruta_img2) {
            unlink($ruta_img2);
        }

        // Elimina la imagen secundaria 3 si existe
        $ruta_img3 = public_path($producto->img3);
        if ($ruta_img3) {
            unlink($ruta_img3);
        }

        // Elimina la imagen secundaria 4 si existe
        $ruta_img4 = public_path($producto->img4);
        if ($ruta_img4) {
            unlink($ruta_img4);
        }

        // Redirige a la vista de administración
        return redirect('/administrar');
    }
    // ----- FIN BORRAR PRODUCTO -----

    // ----- EDITAR PRODUCTO -----
    // Muestra el formulario para editar un producto existente
    public function menuEditar($id)
    {
        $producto = producto::find($id);
        return view('administrar/editarProd', ["producto" => $producto]);
    }

    // Procesa la solicitud para actualizar un producto existente
    public function confirmarCambios(Request $request, $id)
    {
        $producto = producto::find($id);

        // Actualiza los campos del producto con los datos recibidos
        $titulo = $request->input('titulo');
        $producto->titulo = $titulo;

        $descripcion = $request->input('descripcion');
        $producto->descripcion = $descripcion;

        $marca = $request->input('marca');
        $producto->marca = $marca;

        $tipo = $request->input('tipo');
        $producto->tipo = $tipo;

        $genero = $request->input('genero');
        $producto->genero = $genero;

        $categoria_prenda = $request->input('categoria_prenda');
        $producto->categoria_prenda = $categoria_prenda;

        $precio = $request->input('precio');
        $producto->precio = $precio;

        // Imagen principal
        if ($request->hasFile('nueva_imagen')) {
            $file = $request->file("nueva_imagen");
            $nombre = bin2hex(random_bytes(5)) . "." . $file->guessExtension();
            $ruta = "img/productos/" . $id . "/" . $nombre;
            $destino = public_path($ruta);

            // Si la imagen anterior no es la predeterminada, la elimina
            if ($producto->imagen != 'img/productos/default.jpg') {
                $ruta_img = public_path($producto->imagen);
                if ($ruta_img) {
                    unlink($ruta_img);
                }
            }

            // Copia la nueva imagen al destino y actualiza la ruta
            copy($file, $destino);
            $producto->imagen = $ruta;
        }

        // Imagen secundaria 2
        if ($request->hasFile('img2')) {
            $file2 = $request->file("img2");
            $nombre2 = bin2hex(random_bytes(5)) . "." . $file2->guessExtension();
            $ruta2 = "img/productos/" . $id . "/" . $nombre2;
            $destino2 = public_path($ruta2);

            if ($producto->img2 != 'img/productos/default.jpg') {
                $ruta_img2 = public_path($producto->img2);
                if ($ruta_img2) {
                    unlink($ruta_img2);
                }
            }

            copy($file2, $destino2);
            $producto->img2 = $ruta2;
        }

        // Imagen secundaria 3
        if ($request->hasFile('img3')) {
            $file3 = $request->file("img3");
            $nombre3 = bin2hex(random_bytes(5)) . "." . $file3->guessExtension();
            $ruta3 = "img/productos/" . $id . "/" . $nombre3;
            $destino3 = public_path($ruta3);

            if ($producto->img3 != 'img/productos/default.jpg') {
                $ruta_img3 = public_path($producto->img3);
                if ($ruta_img3) {
                    unlink($ruta_img3);
                }
            }

            copy($file3, $destino3);
            $producto->img3 = $ruta3;
        }

        // Imagen secundaria 4
        if ($request->hasFile('img4')) {
            $file4 = $request->file("img4");
            $nombre4 = bin2hex(random_bytes(5)) . "." . $file4->guessExtension();
            $ruta4 = "img/productos/" . $id . "/" . $nombre4;
            $destino4 = public_path($ruta4);

            if ($producto->img4 != 'img/productos/default.jpg') {
                $ruta_img4 = public_path($producto->img4);
                if ($ruta_img4) {
                    unlink($ruta_img4);
                }
            }

            copy($file4, $destino4);
            $producto->img4 = $ruta4;
        }

        // Guarda los cambios en la base de datos
        $producto->save();

        // Redirige a la vista de administración
        return redirect('/administrar');
    }
    // ----- FIN EDITAR PRODUCTO -----
}