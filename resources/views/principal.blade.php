@extends('index')

@section('contenido_principal')
<div>

    <!----- CARRUSEL ----->
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{asset('img/pagina_principal/banner/banner_bañadores2.jpg')}}" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block text-black">
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{asset('img/pagina_principal/banner/banner_zapatillas.jpg')}}" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block text-black">
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{asset('img/pagina_principal/banner/banner_adidas.jpg')}}" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                </div>
            </div>
        </div>

        {{-- CONTROLES DEL CARRUSEL --}}
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

        {{-- SECCIÓN DE CATEGORÍAS DESTACADAS --}}
    <section class="container py-5">
        <div class="row text-center pt-3">
            <div class="col-lg-6 m-auto">
                <h1 class="text-uppercase">Categorias</h1>
            </div>
        </div>
        <div class="row">
            <!--Enlace ropa-->
            <div class="col-12 col-md-4 p-5 mt-3">
                <img src="{{asset('img/pagina_principal/img_prods/ropa.jpg')}}" class="rounded-circle img-fluid">
                <h5 class="text-center mt-3 mb-3">Ropa</h5>
                <p class="text-center"><a href="{{ route('comprarRopa') }}" class="btn btn-primary">Comprar</a></p>
            </div>

            <!--Enlace calzado-->
            <div class="col-12 col-md-4 p-5 mt-3">
                <img src="{{asset('img/pagina_principal/img_prods/zapatos.jpg')}}" class="rounded-circle img-fluid">
                <h2 class="h5 text-center mt-3 mb-3">Calzado</h2>
                <p class="text-center"><a href="{{ route('comprarCalzado') }}" class="btn btn-primary">Comprar</a></p>
            </div>

            <!--Enlace complementos-->
            <div class="col-12 col-md-4 p-5 mt-3">
                <img src="{{asset('img/pagina_principal/img_prods/complementos.jpg')}}"
                    class="rounded-circle img-fluid">
                <h2 class="h5 text-center mt-3 mb-3">Complementos</h2>
                <p class="text-center"><a href="{{ route('comprarComplementos') }}" class="btn btn-primary">Comprar</a>
                </p>
            </div>
        </div>
    </section>
</div>
@endsection