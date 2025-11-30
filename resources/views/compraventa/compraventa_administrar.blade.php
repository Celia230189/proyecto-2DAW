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

    {{-- Botón para añadir un producto a la venta --}}
    <div id="opciones">
        <a href="{{ route('menuNuevoCompraventa') }}" class="btn btn-success">Añadir <i class="fa-solid fa-plus"></i></a>
    </div>

    {{-- Tabla de listado de tus productos en venta --}}
    <table class="table table-hover text-center">
        <thead class="table-dark">
            <tr>
                <th scope="col">Imagen</th>
                <th scope="col">Título</th>
                <th scope="col">Precio</th>
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
                    <td>{{$producto->precio}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>@endsection