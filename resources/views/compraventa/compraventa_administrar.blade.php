@extends('index')

@section('contenido_principal')
<style>
    .imagen {
            width: 50%;
        }

        #imagen-td {
            width: 20%;
        }

        #opciones {
            padding: 2%;
            margin-left: 2%;
        }
</style>

<div style="height: 20px;"></div>

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
                    <td>{{$producto->precio}}</td>

                    {{-- Columna Acciones (EDITAR y BORRAR) --}}
                    <td>
                        {{-- Usamos d-flex para apilar los botones verticalmente --}}
                        <div class="d-flex flex-column align-items-center">
                            {{-- Botón Editar (usa la ruta GET) --}}
                            <a href="{{ route('editarCompraventa', $producto->id) }}" class="btn btn-primary btn-sm mb-2">
                                Editar <i class="fa-solid fa-pen"></i>
                            </a>

                            {{-- Formulario Borrar (POST con token CSRF) --}}
                            <form action="{{route('borrarCompraventa', $producto->id)}}" method="POST">
                                @csrf {{-- Token de seguridad --}}
                                <button class="btn btn-danger btn-sm">Borrar <i class="fa-solid fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection