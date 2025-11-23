<?php

namespace App\Http\Controllers;

use App\Models\producto;
use Illuminate\Http\Request;

class productoController extends Controller
{
    // --- MOSTRAR TODOS (CON FILTROS DINÁMICOS) ---
    public function mostrarProductos(Request $request)
    {
        // Iniciamos la consulta con Eloquent
        $query = producto::query();

        // 1. Filtro por marca
        if ($request->filled('marca')) {
            $query->where('marca', $request->input('marca'));
        }

        // 2. Filtro por género
        if ($request->filled('genero')) {
            $query->where('genero', $request->input('genero'));
        }

        // 3. Filtro por precio máximo
        if ($request->filled('precio_max')) {
            $query->where('precio', '<=', $request->input('precio_max'));
        }

        // 4. Búsqueda por texto (Título o Descripción)
        if ($request->filled('search')) {
            $busqueda = $request->input('search');
            $query->where(function($q) use ($busqueda) {
                $q->where('titulo', 'LIKE', "%{$busqueda}%")
                  ->orWhere('descripcion', 'LIKE', "%{$busqueda}%");
            });
        }

        // Ejecutamos la consulta y obtenemos los resultados
        $listaProductos = $query->get();

        return view('comprar', ['datosProductos' => $listaProductos]);
    }

    // --- MÉTODOS DE CATEGORÍAS ---

    public function mostrarRopa()
    {
        $listaProductos = producto::where('tipo', 'ropa')->get();
        return view('comprar', ['datosProductos' => $listaProductos]);
    }

    public function mostrarCalzado()
    {
        $listaProductos = producto::where('tipo', 'calzado')->get();
        return view('comprar', ['datosProductos' => $listaProductos]);
    }

    public function mostrarComplementos()
    {
        $listaProductos = producto::where('tipo', 'complementos')->get();
        return view('comprar', ['datosProductos' => $listaProductos]);
    }

    public function mostrarHombre()
    {
        $listaProductos = producto::where('genero', 'masculino')->get();
        return view('comprar', ['datosProductos' => $listaProductos]);
    }

    public function mostrarMujer()
    {
        $listaProductos = producto::where('genero', 'femenino')->get();
        return view('comprar', ['datosProductos' => $listaProductos]);
    }

    // --- MOSTRAR PRODUCTO ÚNICO ---
    public function mostrarProductoUnico($id)
    {
        // Si el producto no existe, lanza automáticamente un error 404 (Página no encontrada)
        // en lugar de romper la aplicación.
        $producto = producto::findOrFail($id);
        
        return view('producto', ["producto" => $producto]);
    }
}