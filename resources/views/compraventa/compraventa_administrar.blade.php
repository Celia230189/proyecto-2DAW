@extends('index')

@section('contenido_principal')
<style>
    .imagen {
        width: 100%;
        height: 150px;
        object-fit: cover;
    }

    #imagen-td {
        width: 200px;
    }

    #opciones {
        padding: 2%;
        margin-left: 2%;
    }
</style><div style="height: 20px;"></div>

    {{-- Mensajes de éxito o error --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mx-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show mx-3" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Botón para añadir un producto a la venta --}}
    <div id="opciones">
        <a href="{{ route('menuNuevoCompraventa') }}" class="btn btn-success">Añadir <i class="fa-solid fa-plus"></i></a>
    </div>    {{-- Tabla de listado de tus productos en venta --}}
    <table class="table table-hover text-center">
        <thead class="table-dark">
            <tr>
                <th scope="col">Imagen</th>
                <th scope="col">Título</th>
                <th scope="col">Precio</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datosCompraventa as $producto)
                <tr>
                    {{-- Columna Imagen --}}
                    <td id="imagen-td">
                        <img class="card-img-top imagen" src="{{asset($producto->imagen)}}" alt="..." />
                    </td>
                    {{-- Columna Título y Precio (datos del producto) --}}
                    <td>{{$producto->nombre_producto}}</td>
                    <td>{{$producto->precio}} €</td>
                    
                    {{-- Columna de Acciones (Editar y Borrar) --}}
                    <td>
                        <div class="d-flex flex-column align-items-center gap-2">
                            {{-- Botón Editar --}}
                            <a href="{{ route('editarProdCompraventa', $producto->id) }}" class="btn btn-primary btn-sm">
                                Editar <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            
                            {{-- Formulario Borrar --}}
                            <form action="{{ route('borrarCompraventa', $producto->id) }}" method="POST" 
                                  onsubmit="return confirm('¿Estás seguro de que quieres eliminar este producto?');">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">
                                    Borrar <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>@endsection