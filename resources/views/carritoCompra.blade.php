@extends('index')

@section('contenido_principal')

<section class="pt-5 pb-5">
    <div class="container">
        <div class="row w-100">
            <div class="col-lg-12 col-md-12 col-12">
                <h3 class="display-5 mb-2 text-center">Carrito de la Compra</h3>
                
                {{-- Mensaje de Error --}}
                @if(session('error'))
                    <div class="alert alert-danger text-center">
                        {{ session('error') }}
                    </div>
                @endif

                {{-- Comprobación de Carrito Vacío --}}
                @if ($datosCarrito->isEmpty())
                    <div class="text-center mt-5">
                        <h3>Tu carrito está vacío</h3>
                        <a class="btn btn-primary mt-3" href="{{ route('comprar') }}">Ir a comprar</a>
                    </div>
                @else

                <table id="shoppingCart" class="table table-condensed table-responsive">
                    <thead>
                        <tr>
                            <th style="width:60%">Producto</th>
                            <th style="width:12%">Precio</th>
                            <th style="width:12%">Cantidad</th>
                            <th style="width:16%">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datosCarrito as $item)
                        <tr>
                            <td data-th="Product">
                                <div class="row">
                                    <div class="col-md-3 text-left">
                                        {{-- IMAGEN: Accedemos a través de la relación ->producto --}}
                                        <img src="{{ asset($item->producto->imagen) }}" alt=""
                                            class="img-fluid d-none d-md-block rounded mb-2 shadow ">
                                    </div>
                                    <div class="col-md-9 text-left mt-sm-2">
                                        {{-- TÍTULO Y DESCRIPCIÓN --}}
                                        <h4>{{ $item->producto->titulo }}</h4>
                                        <p class="font-weight-light">{{ $item->producto->descripcion }}</p>
                                    </div>
                                </div>
                            </td>
                            
                            {{-- PRECIO --}}
                            <td data-th="Price">{{ $item->producto->precio * $item->cantidad }} €</td>
                            
                            {{-- COLUMNA CANTIDAD (Con formulario incluido para que sea válido) --}}
                            <td data-th="Quantity">
                                <form action="{{ route('actualizarCantidad', $item->id) }}" method="POST" style="display: flex; align-items: center;">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                    
                                    {{-- Input de cantidad --}}
                                    <input type="number" name="cantidad{{ $item->id }}"
                                        class="form-control form-control-lg text-center"
                                        value="{{ $item->cantidad }}"
                                        min="1"
                                        style="width: 70px; margin-right: 5px;">
                                    
                                    {{-- Botón de actualizar (icono rotar) --}}
                                    <button type="submit" class="btn btn-outline-dark btn-sm" title="Actualizar">
                                        <i class="fa-solid fa-rotate"></i>
                                    </button>
                                </form>
                            </td>

                            {{-- COLUMNA ACCIONES (Solo botón borrar) --}}
                            <td class="actions" data-th="">
                                <div class="text-right">
                                    <form action="{{ route('eliminarProdCarrito') }}" method="GET">
                                        @csrf
                                        <input type="hidden" name="id_borrar" value="{{ $item->id }}">
                                        <button class="btn btn-outline-danger btn-md mb-2">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- SECCIÓN TOTALES --}}
        <div class="row mt-4 d-flex align-items-center">
            <div class="col-sm-6 order-md-2 text-right">
                <h1>Total:</h1>
                {{-- PRECIO TOTAL --}}
                <h1>{{ $precioTotal }} €</h1>
                
                {{-- BOTÓN PAGAR --}}
                <a href="{{ route('pagar') }}" class="btn btn-primary mb-4 btn-lg pl-5 pr-5">PAGAR</a>
            </div>
            
            <div class="col-sm-6 mb-3 mb-m-1 order-md-1 text-md-left">
                <a href="{{ route('comprar') }}">
                    <i class="fa-solid fa-arrow-left mr-2"></i> Continuar Comprando
                </a>
            </div>
        </div>
    </div>
</section>
@endif

@endsection