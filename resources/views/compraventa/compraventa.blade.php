@extends('index')

@section('contenido_principal')
{{-- BANNER PRINCIPAL DE LA SECCIÓN --}}
<div class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">COMPRAVENTA</h1>
            <p class="lead fw-normal text-white-50 mb-0">
                Interactua con otros usuarios de la aplicacion para encontrar lo que buscas
            </p>
        </div>
    </div>
</div>

<br>

{{-- BOTÓN PARA SUBIR PRODUCTO --}}
<div class="text-center mb-4">
    <a href="{{ route('menuNuevoCompraventa') }}" class="btn btn-success btn-lg">
        Subir producto de segunda mano
    </a>
</div>


{{-- SECCIÓN DE LISTADO DE PRODUCTOS --}}
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

            @foreach ($datosCompraventa as $producto)
            <div class="col mb-5">
                <div class="card h-100">
                    {{-- Imagen del producto --}}
                    <img class="card-img-top" src="{{asset($producto->imagen)}}" alt="..." />
                    
                    {{-- Detalles y acciones --}}
                    <div class="card-body p-4">
                        <div class="text-center">
                            {{-- Nombre del producto --}}
                            <h5 class="fw-bolder">{{$producto->nombre_producto}}</h5>

                            {{-- Usamos number_format para asegurar dos decimales --}}
                            {{number_format($producto->precio, 2)}} €
                        </div>
                        
                        {{-- Botón Ver Producto --}}
                        <div class="text-center">
                            <form action="{{route('productoCompraventa', $producto->id)}}" method="POST">
                                @csrf
                                <input type="hidden" name="id_borrar" value="{{$producto->id}}">
                                <button class="btn btn-outline-dark mt-auto" type="submit">Ver producto</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach


        </div>
    </div>
</section>


{{-- Script de Bootstrap y archivos JS personalizados (están en la carpeta public) --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/scripts.js"></script>
@endsection