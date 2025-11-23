@extends('index')

@section('contenido_principal')
<div style="height: 42px;"></div>
<div class="page-content page-container" id="page-content">
    <div class="padding">
        <div class="row container d-flex justify-content-center">
            <div class="col-xl-6 col-md-12">
                <div class="card user-card-full">
                    <div class="row m-l-0 m-r-0">

                        {{-- Columna izquierda perfil y saldo --}}
                        <div class="col-sm-4 bg-c-lite-green user-profile">
                            <div class="card-block text-center text-white">
                                <div class="m-b-25">
                                    <img src="https://img.icons8.com/bubbles/100/000000/user.png" class="img-radius"
                                        alt="User-Profile-Image">
                                </div>
                                {{-- Nombre de usuario--}}
                                <h5 class="f-w-600">{{ Auth::user()->name }}</h5>
                                <br>
                                {{-- Accede a la columna saldo de la BD --}}
                                <p>Saldo: {{ Auth::user()->saldo }} €</p>
                                <br>
                                {{-- Botón cerrar sesión --}}
                                <a class="btn text-white" href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">Cerrar sesion <i
                                        class="fa-solid fa-right-from-bracket"></i></a>
                            </div>
                        </div>
                        {{-- Columna derecha detalles y acciones --}}
                        <div class="col-sm-8">
                            <div class="card-block">
                                <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Información</h6>
                                <div class="row">
                                    {{-- Email --}}
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Email</p>
                                        <h6 class="text-muted f-w-400">{{ Auth::user()->email }}</h6>
                                    </div>
                                    {{-- Enlace de administración (solo funciona si tipo_usuario=1) --}}
                                    <div class="col-sm-6" id="administrar">
                                        <p class="m-b-10 f-w-600">Administrar</p>
                                        {{-- El middleware 'admin' proteferá esta ruta en el controlador --}}
                                        <a href="{{ route('administrar') }}" class="btn text-muted"><i
                                                class="fa-solid fa-screwdriver-wrench"></i></a>
                                    </div>
                                </div>
                                <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">Acciones</h6>
                                <div class="row">
                                    {{-- Favoritos con contador --}}
                                    <div class="col-sm-6 position-relative">
                                        <p class="m-b-10 f-w-600">Favoritos</p>
                                        <a href="{{ route('favoritos') }}" class="text-muted f-w-400 d-inline-flex align-items-center">
                                            <i class="fa-solid fa-heart fa-lg"></i>
                                            @auth
                                            {{-- Contador inyectado por AppServiceProvider --}}
                                                @if(!empty($favCount) && $favCount > 0)
                                                    <span class="badge bg-primary ms-2" style="font-size: 0.75rem; padding:0.25rem 0.4rem">
                                                        {{ $favCount }}
                                                    </span>
                                                @endif
                                            @endauth
                                        </a>
                                    </div>
                                    {{-- Carrito con contador --}}
                                    <div class="col-sm-6 position-relative">
                                        <p class="m-b-10 f-w-600">Carrito de la compra</p>
                                        <a href="{{ route('mostrarProductoCarrito') }}" class="text-muted f-w-400 d-inline-flex align-items-center">
                                            <i class="fa-solid fa-cart-shopping fa-lg"></i>
                                            @auth
                                            {{-- Contador inyectado por AppServiceProvider --}}
                                                @if(!empty($carritoCount) && $carritoCount > 0)
                                                    <span class="badge bg-danger ms-2" style="font-size:0.75rem; padding:0.25rem 0.4rem">
                                                        {{ $carritoCount }}
                                                    </span>
                                                @endif
                                            @endauth
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>


</div>

<div style="height: 50px;"></div>
@endsection