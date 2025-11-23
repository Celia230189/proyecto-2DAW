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
            </div>
        </div>
    </div>
</section>

@endsection