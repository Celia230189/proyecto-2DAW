@extends('index')

@section('contenido_principal')

<style>
  .imagen-producto {
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

{{-- - Botón para añadir un nuevo producto --}}
<div id="opciones">
  <a href="{{route('menuNuevo')}}" class="btn btn-success">Añadir <i class="fa-solid fa-plus"></i></a>
</div>

{{-- Tabla que lista todos los productos --}}
<table class="table table-hover text-center">
  <thead class="table-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Imagen</th>
      <th scope="col">Título</th>
      <th scope="col">Precio</th>
      <th scope="col">Tipo</th>
      <th scope="col">Acciones</th>
    </tr>
  </thead>
  <tbody>
    @foreach ( $datosProductos as $producto ) {{-- Bucle de laravle para iterar sobre la lista de productos --}}
      <tr>
        <th scope="row">{{$producto->id}}</th> {{-- Muestra el id del producto --}}
          
        {{-- Columna de la imagen --}}
        <td id="imagen-td">
           {{-- La función asset() genera la URL correcta para la ruta pública --}}
           <img class="card-img-top imagen-producto" src="{{asset($producto->imagen)}}" alt="..."/>
        </td>

        <td>{{$producto->titulo}}</td> {{-- Muestra el título --}}
        <td>{{$producto->precio}}</td> {{-- Muestra el precio --}}
        <td>{{$producto->tipo}}</td> {{-- Muestra el tipo --}}

        {{-- Columna de Acciones (Editar y Borrar) --}}
        <td>
          {{-- Contenedor para alinear los botones verticalmente --}}
          <div class="d-flex flex-column align-items-center"> 
             {{-- FORMULARIO DE EDICIÓN --}}
              <form action="{{route('menuEditar', $producto->id)}}" method="POST" class="mb-2">
                 @csrf {{-- Token de seguridad CSRF (imprescindible en todos los formularios POST) --}}
                  <button class="btn btn-primary btn-sm">Editar <i class="fa-solid fa-pen-to-square"></i></button>
              </form>

              {{-- FORMULARIO DE BORRADO --}}
              <form action="{{route('borrar', $producto->id)}}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este producto?');">
                @csrf {{-- Token de seguridad CSRF --}}
                <button type="submit" class="btn btn-danger btn-sm">Borrar <i class="fa-solid fa-trash"></i></button>
              </form>
          </div>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>