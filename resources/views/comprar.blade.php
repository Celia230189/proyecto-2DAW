@extends('index')

@section('contenido_principal')
{{-- BANNER PRINCIPAL --}}
<div class="position-relative overflow-hidden" style="height: 65vh; min-height: 350px;">

    {{-- Imagen de Fondo (Bannner) --}}
    <img src="{{asset('img/pagina_principal/banner/playeros.png')}}" class="d-block w-100 h-100" alt="Banner de Compras" style="object-fit: cover; filter: brightness(0.5);">

    {{-- Contenido del Banner --}}
    <div class="position-absolute top-50 start-50 translate-middle text-center text-white w-100">
        <h1 class="display-4 fw-bolder">{{ $tituloBanner ?? 'COMPRAR' }}</h1>
        <p class="lead fw-normal mb-0">{{ $descripcionBanner ?? 'Encuentra lo que buscas entre una gran cantidad de productos' }}</p>
    </div>
</div>

    <br>

{{-- BOTÓN PARA DESPLEGAR FILTROS --}}
    <a class="btn btn-primary" id="boton_filtros" data-bs-toggle="collapse" href="#filtros" role="button"
        aria-expanded="false" aria-controls="filtros">
        FILTROS <i class="fa-solid fa-filter"></i>
    </a>

{{-- BLOQUE DE FILTROS COLAPSABLE --}}
    <div class="collapse" id="filtros">

        <div class="s007">
            {{-- FORMULARIO DE FILTRO: Usa método GET para que los filtros se guarden en la URL --}}
            <form method="GET" action="{{ route('comprar') }}">
                <div class="inner-form container-fluid">
                    
                    {{-- BÚSQUEDA BÁSICA (Texto) --}}
                    <div class="basic-search">
                        <div class="input-field">
                            <div class="icon-wrap">
                                {{-- Icono de la lupa (SVG inline) --}}
                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20" viewBox="0 0 20 20">
                                    <path
                                        d="M18.869 19.162l-5.943-6.484c1.339-1.401 2.075-3.233 2.075-5.178 0-2.003-0.78-3.887-2.197-5.303s-3.3-2.197-5.303-2.197-3.887 0.78-5.303 2.197s-2.197 3.3-2.197 5.303 0.78 3.887 2.197 5.303 3.3 2.197 5.303 2.197c1.726 0 3.362-0.579 4.688-1.645l5.943 6.483c0.099 0.108 0.233 0.162 0.369 0.162 0.121 0 0.242-0.043 0.338-0.131 0.204-0.187 0.217-0.503 0.031-0.706zM1 7.5c0-3.584 2.916-6.5 6.5-6.5s6.5 2.916 6.5 6.5-2.916 6.5-6.5 6.5-6.5-2.916-6.5-6.5z">
                                    </path>
                                </svg>
                            </div>
                            <input id="search" name="search" type="text" placeholder="Buscar..." />
                        </div>
                    </div>
                    
                    {{-- BÚSQUEDA AVANZADA --}}
                    <div class="advance-search">
                        <span class="desc">Busqueda avanzada</span>

                        <div class="row g-3 align-items-end">
                            
                            {{-- Filtro por Marca (usando Choices.js) --}}
                            <div class="input-field">
                                <div class="input-select">
                                    <select data-trigger name="marca" class="form-select">
                                        <option value="">MARCA</option>
                                        <option>Adidas</option>
                                        <option>Nike</option>
                                        <option>Vans</option>
                                        <option>Levis</option>
                                    </select>
                                </div>
                            </div>
                            
                            {{-- Filtro por Género (usando Choices.js) --}}
                            <div class="input-field">
                                <div class="input-select">
                                    <select data-trigger="" name="genero" class="form-select">
                                        <option value="">GENERO</option>
                                        <option>Masculino</option>
                                        <option>Femenino</option>
                                        <option>Unisex</option>
                                    </select>
                                </div>
                            </div>
                            
                            {{-- Filtro por Precio Máximo --}}
                            <div class="mb-3">
                                <label for="precio" class="form-label">Precio (€)</label>
                                
                                {{-- Usamos type="number" step="0.01" para el decimal (coherencia con la BD) --}}
                                <input type="number" step="0.01" name="precio_max" id="precio" class="form-control" placeholder="">
                            </div>
                        </div>
                        
                        {{-- Botones de acción del formulario --}}
                        <div class="row third">
                            <div class="input-field">
                                <button class="btn-search">Buscar</button>
                                <button class="btn-delete" id="delete">Borrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        
        {{-- SCRIPT PARA FILTROS (Choices.js y Borrar) --}}
        <script>
            // inicializar Choices y guardar instancia en cada select
            const selects = document.querySelectorAll('select[data-trigger]');
            selects.forEach(select => {
                if (typeof Choices !== 'undefined') {
                    const instance = new Choices(select, {
                        searchEnabled: false,
                        removeItemButton: true,
                        itemSelectText: ''
                    });

                    // guardamos la instancia en el propio select
                    select.choices = instance;
                }
            });

            // función borrar filtros
            document.getElementById('delete').addEventListener('click', function (e) {
                e.preventDefault(); // evita el submit del form

                // limpiar inputs de texto y numero    
                document.querySelectorAll('#search, input[type="number"]').forEach(input => input.value = '');

                // resetear selects Choices
                selects.forEach(select => {
                    if (select.choices) {
                        select.choices.clearStore();
                        select.choices.setChoiceByValue([""]);
                    } else {
                        select.selectedIndex = 0;
                    }
                });
            });


        </script>

    </div>
    <!-- ---------FIN FILTROS-------- -->


    {{-- SECCIÓN DE LISTADO DE PRODUCTOS --}}
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @if(empty($datosProductos))
                    <div class="alert alert-warning text-center mt-4 w-100">
                        No se han encontrado productos con esos criterios de búsqueda.
                    </div>
                @else
                    @foreach ($datosProductos as $producto)
                        <div class="col mb-5">
                            <div class="card h-100">
                                {{-- Imagen del producto --}}
                                <img class="card-img-top" src="{{asset($producto->imagen)}}" alt="..." />
                                
                                {{-- Detalles --}}
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        {{-- Nombre del producto --}}
                                        <h5 class="fw-bolder">{{$producto->titulo}}</h5>
                                        {{-- Precio --}}
                                        {{number_format($producto->precio, 2)}} €
                                    </div>
                                </div>
                                {{-- Acciones --}}
                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                    <div class="text-center"><a class="btn btn-outline-dark mt-auto"
                                            href="{{route('mostrarProductoUnico', $producto->id)}}">Ver producto</a></div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
    {{-- Archivos JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>
@endsection