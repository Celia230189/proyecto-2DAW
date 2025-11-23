@extends('index')

@section('contenido_principal')


{{-- SECCIÓN PRINCIPAL DE DETALLE --}}
<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">

            {{-- COLUMNA IZQUIERDA CARRUSEL DE IMÁGENES --}}
            <div class="col-md-6">
                <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                    
                    {{-- Indicadores del carrusel --}}                
                    <div class="carousel-indicators">
                        <button type="button" style="background-color: black;" data-bs-target="#carouselExampleCaptions"
                            data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" style="background-color: black;" data-bs-target="#carouselExampleCaptions"
                            data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" style="background-color: black;" data-bs-target="#carouselExampleCaptions"
                            data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>

                    {{-- Contenido del Carrusel --}}
                    <div class="carousel-inner">

                        {{-- Ítem Principal (Active) --}}
                        <div class="carousel-item active">
                            <img src="{{ asset($producto->imagen) }}" class="d-block w-100" alt="Imagen principal">
                        </div>

                        {{-- Ítem 2: Solo si existe el campo img2 --}}
                        @if($producto->img2)
                        <div class="carousel-item">
                            <img src="{{ asset($producto->img2) }}" class="d-block w-100" alt="Imagen 2">
                        </div>
                        @endif

                        {{-- Ítem 3: Solo si existe el campo img3 --}}
                        @if($producto->img3)
                        <div class="carousel-item">
                            <img src="{{ asset($producto->img3) }}" class="d-block w-100" alt="Imagen 3">
                        </div>
                        @endif

                        {{-- Ítem 4: Solo si existe el campo img4 --}}
                        @if($producto->img4)
                        <div class="carousel-item">
                            <img src="{{ asset($producto->img4) }}" class="d-block w-100" alt="Imagen 4">
                        </div>
                        @endif
                    </div>

                     {{-- Controles Anterior/Siguiente --}}
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                        data-bs-slide="prev">
                        <i class="fa-solid fa-chevron-left text-black"></i>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                        data-bs-slide="next">
                        <i class="fa-solid fa-chevron-right text-black"></i>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

            {{-- COLUMNA DERECHA: DETALLES Y ACCIONES --}}
            <div class="col-md-6">
                <h1 class="display-5 fw-bolder">{{$producto->titulo}}</h1>

                {{-- Precio (Formatado para dos decimales, coherente con la BD) --}}
                <div class="fs-5 mb-5">
                    <span>{{number_format($producto->precio, 2)}} €</span>
                </div>

                <p class="lead">{{$producto->descripcion}}</p>

                {{-- BOTONES DE ACCIÓN --}}
                <div class="d-flex">

                    {{-- Formulario: Añadir al Carrito --}}
                    <form action="{{ route('guardarProductoCarrito') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_producto" value="{{$producto->id}}">
                        <button class="btn btn-outline-dark flex-shrink-0" type="submit">Añadir al carrito</button>
                    </form>
                     
                    {{-- Formulario: Añadir a Favoritos --}}
                    <form action="{{ route('añadirFavorito') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_producto" value="{{$producto->id}}">
                        <button class="btn btn-outline-dark flex-shrink-0" type="submit"><i
                                class="fa-solid fa-heart"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection