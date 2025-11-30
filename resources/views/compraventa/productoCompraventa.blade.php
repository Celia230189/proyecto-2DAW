@extends('index')

@section('contenido_principal')
<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            
            {{-- Columna de Imagen --}}
            <div class="col-md-6">
                {{-- Muestra la imagen principal del producto --}}
                <img src="{{asset($producto->imagen)}}" class="d-block w-100" alt="Imagen del producto">
            </div>
            
            {{-- Columna de Detalles --}}
            <div class="col-md-6">
                {{-- Nombre del Producto --}}
                <h1 class="display-5 fw-bolder">{{$producto->nombre_producto}}</h1>
                
                {{-- Precio --}}
                <div class="fs-5 mb-5">
                    {{-- Usamos number_format para asegurar dos decimales --}}
                    <span>{{number_format($producto->precio, 2)}} €</span>
                </div>
                
                {{-- Descripción --}}
                <p class="lead">{{$producto->descripcion_producto}}</p>
                
                {{-- Contacto del Vendedor --}}
                <p class="lead"><u>Contacto:</u> {{$producto->contacto}}</p>

                {{-- Botones de Editar y Eliminar solo si es el dueño --}}
                @auth
                    @if($producto->id_user == auth()->user()->id)
                        <div class="d-flex gap-2 mt-4">
                            {{-- Botón Editar --}}
                            <a href="{{ route('editarCompraventa', $producto->id) }}" class="btn btn-warning">
                                <i class="fa-solid fa-pen-to-square"></i> Editar Producto
                            </a>
                            
                            {{-- Botón Eliminar --}}
                            <form action="{{ route('borrarCompraventa', $producto->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este producto?');" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger">
                                    <i class="fa-solid fa-trash"></i> Eliminar Producto
                                </button>
                            </form>
                        </div>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</section>

@endsection
