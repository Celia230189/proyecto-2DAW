<?php

namespace App\Http\Controllers;

use App\Models\compraventa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class compraventaController extends Controller
{
    // Mostrar todo (público)
    public function mostrarCompraventa()
    {
        $listaProductos = compraventa::all();

        return view('compraventa/compraventa', ['datosCompraventa' => $listaProductos]);
    }

    // Mis productos (privado)
    public function mostrarProductosCompraventa()
    {
        // Filtra por el id del usuario conectado para mostrar sus ventas
        $listaProductos = DB::select('SELECT * FROM compraventas WHERE id_user = ' . auth()->user()->id);
        return view('compraventa/compraventa_administrar', ['datosCompraventa' => $listaProductos]);
    }

    // Carga y muestra la vista del formulario
    public function menuNuevoCompraventa()
    {
        return view('compraventa/nuevoProdCompraventa');
    }

    // Creación y guardado con validación
    public function nuevoProdCompraventa(Request $request)
    {
        $request->validate([
            'nombre_producto' => 'required|string|max:255',
            'descripcion_producto' => 'required|string',
            'precio' => 'required|numeric|min:0',
            'contacto' => 'required|string|max:255'
        ], [
            'required' => 'Todos los campos son obligatorios.',
            'precio.numeric' => 'El precio debe ser un número.',
            'nueva_imagen.required' => 'La imagen es obligatoria.',
        ]);

        $producto_compraventa = new compraventa;

        $id_user = auth()->user()->id;
        $producto_compraventa->id_user = $id_user;

        if ($request->hasFile('nueva_imagen')) {
            $file = $request->file("nueva_imagen");
            $nombre = bin2hex(random_bytes(5)) . "." . $file->guessExtension();
            $ruta = "img/compraventa/" . $nombre;
            $destino = public_path("img/compraventa");

            // Crea el directorio si no existe
            if (!file_exists($destino)) {
                mkdir($destino, 0755, true);
            }
            $file->move($destino, $nombre);
            $producto_compraventa->imagen = $ruta;
        }

        $nombre_producto = $request->nombre_producto;
        $producto_compraventa->nombre_producto = $nombre_producto;

        $descripcion_producto = $request->descripcion_producto;
        $producto_compraventa->descripcion_producto = $descripcion_producto;

        $precio = $request->precio;
        $producto_compraventa->precio = $precio;

        $contacto = $request->contacto;
        $producto_compraventa->contacto = $contacto;

        $producto_compraventa->save();

        $listaProductos = DB::select('SELECT * FROM compraventas WHERE id_user = ' . auth()->user()->id);

        return view('compraventa/compraventa_administrar', ['datosCompraventa' => $listaProductos]);
    }

    
    // Editar con seguridad de propiedad
    public function editarProdCompraventa($id)
    {
        $producto = compraventa::findOrFail($id);

        // Comprobamos que el producto pertenece al usuario
        if ($producto->id_user != auth()->user()->id) {
            abort(403);
        }

        return view('compraventa/editarProdCompraventa', compact('producto'));
    }

    
    // Actualizar 
    public function actualizarProdCompraventa(Request $request, $id)
    {

        $request->validate([
            'nueva_imagen' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'nombre_producto' => 'required|string|max:255',
            'descripcion_producto' => 'required|string',
            'precio' => 'required|numeric|min:0',
            'contacto' => 'required|string|max:255'
        ], [
            'required' => 'Todos los campos son obligatorios.',
            'precio.numeric' => 'El precio debe ser un número.'
        ]);

        $producto = compraventa::findOrFail($id);

        // Comprobamos que el producto pertenece al usuario
        if ($producto->id_user != auth()->user()->id) {
            abort(403);
        }

        // Imagen nueva si la hay
        if ($request->hasFile('nueva_imagen')) {
            $file = $request->file("nueva_imagen");
            $nombre = bin2hex(random_bytes(5)) . "." . $file->guessExtension();
            $ruta = "img/compraventa/" . $nombre;
            $destino = public_path("img/compraventa");

            // Crea el directorio si no existe
            if (!file_exists($destino)) {
                mkdir($destino, 0755, true);
            }
            $file->move($destino, $nombre);
            $producto->imagen = $ruta;
        }

        // Actualizar datos
        $producto->nombre_producto = $request->nombre_producto;
        $producto->descripcion_producto = $request->descripcion_producto;
        $producto->precio = $request->precio;
        $producto->contacto = $request->contacto;

        $producto->save();

        return redirect()->route('compraventa_administrar')
            ->with('success', 'Producto actualizado correctamente');
    }


    public function productoUnicoCompraventa($id)
    {
        $producto = compraventa::find($id);
        return view('compraventa/productoCompraventa', ["producto" => $producto]);
    }

    public function borrarProdCompraventa($id)
    {
        $producto = compraventa::find($id);
        $producto->delete();

        $listaProductos = DB::select('SELECT * FROM compraventas WHERE id_user = ' . auth()->user()->id);

        return view('compraventa/compraventa_administrar', ['datosCompraventa' => $listaProductos]);
    }
}