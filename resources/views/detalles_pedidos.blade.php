@extends('index')

@section('contenido_principal')
    <div style="height: 56px;"></div>
    <div class="container p-0">
        <div class="card px-4">
            <p class="h8 py-3">Detalles de Pago</p>
            
            {{-- Mensaje de error de saldo (viene del controlador) --}}
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Errores de validación (campos obligatorios faltantes) --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Formulario final del checkout --}}
            <form action="{{ route('guardarDetallesPedido') }}" method="POST">
                @csrf {{-- Token de seguridad--}}
                <div class="row gx-3">

                    {{-- Campo nombre --}}
                    <div class="col-12">
                        <div class="d-flex flex-column">
                            <p class="text mb-1">Nombre</p>
                            <input name="nombre" class="form-control mb-3" type="text" value="{{ old('nombre') }}">
                        </div>
                    </div>

                    {{-- Campo dirección --}}
                    <div class="col-12">
                        <div class="d-flex flex-column">
                            <p class="text mb-1">Direccion</p>
                            <input name="direccion" class="form-control mb-3" type="text" value="{{ old('direccion') }}">
                        </div>
                    </div>

                    {{-- Campo país --}}
                    <div class="col-6">
                        <div class="d-flex flex-column">
                            <p class="text mb-1">Pais</p>
                            <input name="pais" class="form-control mb-3" type="text" value="{{ old('pais') }}">
                        </div>
                    </div>

                    {{-- Campo cuidad --}}
                    <div class="col-6">
                        <div class="d-flex flex-column">
                            <p class="text mb-1">Ciudad</p>
                            <input name="ciudad" class="form-control mb-3 pt-2 " type="text" value="{{ old('ciudad') }}">
                        </div>
                    </div>
                    
                    {{-- Botón de pago --}}
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary mb-3">
                        {{-- Muestra el precio final calculado de forma segura --}}    
                        Pagar {{$precioTotal}} €
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div style="height: 56px;"></div>

@endsection