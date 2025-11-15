<?php


// Definimos el espacio de nombres para los controladores de la aplicación
namespace App\Http\Controllers;


// Importamos el modelo producto, la clase Request y el facade DB para consultas directas
use App\Models\producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


// Controlador encargado de mostrar productos y aplicar filtros
class productoController extends Controller
{
    // --- Mostrar todos los productos (con filtros)---
    // Muestra todos los productos aplicando filtros de marca, género, precio y búsqueda de texto
    public function mostrarProductos(Request $request)
    {
        $sql = "SELECT * FROM productos WHERE 1=1";
        $params = [];

        // Filtro por marca
        if ($request->filled('marca')) {
            $sql .= " AND marca = ?";
            $params[] = $request->input('marca');
        }

        // Filtro por género
        if ($request->filled('genero')) {
            $sql .= " AND genero = ?";
            $params[] = $request->input('genero');
        }

        // Filtro por precio máximo
        if ($request->filled('precio_max')) {
            $sql .= " AND precio <= ?";
            $params[] = $request->input('precio_max');
        }

        // Búsqueda por texto en título o descripción
        if ($request->filled('search')) {
            $sql .= " AND (titulo LIKE ? OR descripcion LIKE ?)";
            $params[] = "%" . $request->input('search') . "%";
            $params[] = "%" . $request->input('search') . "%";
        }

        // Ejecuta la consulta con los filtros aplicados
        $listaProductos = DB::select($sql, $params);

        // Retorna la vista con los productos filtrados
        return view('comprar', ['datosProductos' => $listaProductos]);
    }

    // --- Mostrar ropa ---
    // Muestra solo los productos cuyo tipo es 'ropa'
    public function mostrarRopa()
    {
        $listaProductos = DB::select('SELECT * FROM productos WHERE tipo = ?', ['ropa']);
        return view('comprar', ['datosProductos' => $listaProductos]);
    }

    // --- Mostrar calzado ---
    // Muestra solo los productos cuyo tipo es 'calzado'
    public function mostrarCalzado()
    {
        $listaProductos = DB::select('SELECT * FROM productos WHERE tipo = ?', ['calzado']);
        return view('comprar', ['datosProductos' => $listaProductos]);
    }

    // --- Mostrar complementos ---
    // Muestra solo los productos cuyo tipo es 'complementos'
    public function mostrarComplementos()
    {
        $listaProductos = DB::select('SELECT * FROM productos WHERE tipo = ?', ['complementos']);
        return view('comprar', ['datosProductos' => $listaProductos]);
    }

    // --- Mostrar hombre ---
    // Muestra solo los productos cuyo género es 'masculino'
    public function mostrarHombre()
    {
        $listaProductos = DB::select('SELECT * FROM productos WHERE genero = ?', ['masculino']);
        return view('comprar', ['datosProductos' => $listaProductos]);
    }

    // --- Mostrar mujer ---
    // Muestra solo los productos cuyo género es 'femenino'
    public function mostrarMujer()
    {
        $listaProductos = DB::select('SELECT * FROM productos WHERE genero = ?', ['femenino']);
        return view('comprar', ['datosProductos' => $listaProductos]);
    }

    // --- Mostrar solo un producto ---
    // Muestra la vista de un producto individual según su id
    public function mostrarProductoUnico($id)
    {
        $producto = producto::find($id);
        return view('producto', ["producto" => $producto]);
    }
}