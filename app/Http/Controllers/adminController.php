<?php

namespace App\Http\Controllers;

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

        // Guarda el producto primero para obtener el ID
        $producto->save();

        // Procesa las imágenes después de guardar para tener el ID del producto
        $id = $producto->id;

        // Imagen principal
        if ($request->hasFile('nueva_imagen')) {
            $file = $request->file("nueva_imagen");
            $extension = $file->getClientOriginalExtension();
            $nombre = bin2hex(random_bytes(5)) . "." . $extension;
            $ruta = "img/productos/" . $id . "/" . $nombre;
            $destino = public_path("img/productos/" . $id);

            // Crea el directorio si no existe
            if (!file_exists($destino)) {
                mkdir($destino, 0755, true);
            }
            $file->move($destino, $nombre);
            $producto->imagen = $ruta;
        }

        // Imagen secundaria 2
        if ($request->hasFile('img2')) {
            $file2 = $request->file("img2");
            $extension2 = $file2->getClientOriginalExtension();
            $nombre2 = bin2hex(random_bytes(5)) . "." . $extension2;
            $ruta2 = "img/productos/" . $id . "/" . $nombre2;
            $destino2 = public_path("img/productos/" . $id);

            if (!file_exists($destino2)) {
                mkdir($destino2, 0755, true);
            }
            $file2->move($destino2, $nombre2);
            $producto->img2 = $ruta2;
        }

        // Imagen secundaria 3
        if ($request->hasFile('img3')) {
            $file3 = $request->file("img3");
            $extension3 = $file3->getClientOriginalExtension();
            $nombre3 = bin2hex(random_bytes(5)) . "." . $extension3;
            $ruta3 = "img/productos/" . $id . "/" . $nombre3;
            $destino3 = public_path("img/productos/" . $id);

            if (!file_exists($destino3)) {
                mkdir($destino3, 0755, true);
            }
            $file3->move($destino3, $nombre3);
            $producto->img3 = $ruta3;
        }

        // Imagen secundaria 4
        if ($request->hasFile('img4')) {
            $file4 = $request->file("img4");
            $extension4 = $file4->getClientOriginalExtension();
            $nombre4 = bin2hex(random_bytes(5)) . "." . $extension4;
            $ruta4 = "img/productos/" . $id . "/" . $nombre4;
            $destino4 = public_path("img/productos/" . $id);

            if (!file_exists($destino4)) {
                mkdir($destino4, 0755, true);
            }
            $file4->move($destino4, $nombre4);
            $producto->img4 = $ruta4;
        }

        // Guarda las rutas de las imágenes
        $producto->save();

        // Redirige a la vista de administración
        return redirect('/administrar')->with('success', 'Producto creado correctamente');
    }
    // ----- FIN AÑADIR PRODUCTO -----

    // ----- BORRAR PRODUCTO -----
    // Elimina un producto y sus imágenes asociadas
    public function borrar($id)
    {
        $producto = producto::find($id);
        
        if (!$producto) {
            return redirect('/administrar')->with('error', 'Producto no encontrado');
        }

        // Elimina la imagen principal si existe y no es la predeterminada
        if ($producto->imagen && $producto->imagen != 'img/productos/default.jpg') {
            $ruta_img = public_path($producto->imagen);
            if (file_exists($ruta_img)) {
                @unlink($ruta_img);
            }
        }

        // Elimina la imagen secundaria 2 si existe y no es la predeterminada
        if ($producto->img2 && $producto->img2 != 'img/productos/default.jpg') {
            $ruta_img2 = public_path($producto->img2);
            if (file_exists($ruta_img2)) {
                @unlink($ruta_img2);
            }
        }

        // Elimina la imagen secundaria 3 si existe y no es la predeterminada
        if ($producto->img3 && $producto->img3 != 'img/productos/default.jpg') {
            $ruta_img3 = public_path($producto->img3);
            if (file_exists($ruta_img3)) {
                @unlink($ruta_img3);
            }
        }

        // Elimina la imagen secundaria 4 si existe y no es la predeterminada
        if ($producto->img4 && $producto->img4 != 'img/productos/default.jpg') {
            $ruta_img4 = public_path($producto->img4);
            if (file_exists($ruta_img4)) {
                @unlink($ruta_img4);
            }
        }

        // Ahora sí borra el registro de la base de datos
        $producto->delete();

        // Redirige a la vista de administración
        return redirect('/administrar')->with('success', 'Producto eliminado correctamente');
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
            $extension = $file->getClientOriginalExtension();
            $nombre = bin2hex(random_bytes(5)) . "." . $extension;
            $ruta = "img/productos/" . $id . "/" . $nombre;
            $destino = public_path("img/productos/" . $id);

            // Si la imagen anterior no es la predeterminada, la elimina
            if ($producto->imagen != 'img/productos/default.jpg') {
                $ruta_img = public_path($producto->imagen);
                if (file_exists($ruta_img)) {
                    unlink($ruta_img);
                }
            }

            // Crea el directorio si no existe y mueve la imagen
            if (!file_exists($destino)) {
                mkdir($destino, 0755, true);
            }
            $file->move($destino, $nombre);
            $producto->imagen = $ruta;
        }

        // Imagen secundaria 2
        if ($request->hasFile('img2')) {
            $file2 = $request->file("img2");
            $extension2 = $file2->getClientOriginalExtension();
            $nombre2 = bin2hex(random_bytes(5)) . "." . $extension2;
            $ruta2 = "img/productos/" . $id . "/" . $nombre2;
            $destino2 = public_path("img/productos/" . $id);

            if ($producto->img2 != 'img/productos/default.jpg') {
                $ruta_img2 = public_path($producto->img2);
                if (file_exists($ruta_img2)) {
                    unlink($ruta_img2);
                }
            }

            if (!file_exists($destino2)) {
                mkdir($destino2, 0755, true);
            }
            $file2->move($destino2, $nombre2);
            $producto->img2 = $ruta2;
        }

        // Imagen secundaria 3
        if ($request->hasFile('img3')) {
            $file3 = $request->file("img3");
            $extension3 = $file3->getClientOriginalExtension();
            $nombre3 = bin2hex(random_bytes(5)) . "." . $extension3;
            $ruta3 = "img/productos/" . $id . "/" . $nombre3;
            $destino3 = public_path("img/productos/" . $id);

            if ($producto->img3 != 'img/productos/default.jpg') {
                $ruta_img3 = public_path($producto->img3);
                if (file_exists($ruta_img3)) {
                    unlink($ruta_img3);
                }
            }

            if (!file_exists($destino3)) {
                mkdir($destino3, 0755, true);
            }
            $file3->move($destino3, $nombre3);
            $producto->img3 = $ruta3;
        }

        // Imagen secundaria 4
        if ($request->hasFile('img4')) {
            $file4 = $request->file("img4");
            $extension4 = $file4->getClientOriginalExtension();
            $nombre4 = bin2hex(random_bytes(5)) . "." . $extension4;
            $ruta4 = "img/productos/" . $id . "/" . $nombre4;
            $destino4 = public_path("img/productos/" . $id);

            if ($producto->img4 != 'img/productos/default.jpg') {
                $ruta_img4 = public_path($producto->img4);
                if (file_exists($ruta_img4)) {
                    unlink($ruta_img4);
                }
            }

            if (!file_exists($destino4)) {
                mkdir($destino4, 0755, true);
            }
            $file4->move($destino4, $nombre4);
            $producto->img4 = $ruta4;
        }

        // Guarda los cambios en la base de datos
        $producto->save();

        // Redirige a la vista de administración
        return redirect('/administrar');
    }
    // ----- FIN EDITAR PRODUCTO -----
}