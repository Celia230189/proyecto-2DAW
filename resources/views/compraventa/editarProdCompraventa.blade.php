@extends('index')

@section('contenido_principal')

    <div style="height: 20px;"></div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="{{ route('actualizarCompraventa', $producto->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="text-center">
            <label for="file-input">
                <img class="editar_imagen img-responsive" src="{{ asset($producto->imagen) }}"
                    style="width:200px;border-radius:10px;cursor:pointer;" />
            </label>
            <input onchange="mostrar_nueva_img(this)" id="file-input" type="file" name="nueva_imagen"
                style="display:none" />
        </div>
        <br>

        <div class="container" style="max-width:500px;">

            <label>Nombre del producto</label>
            <input required type="text" class="form-control" name="nombre_producto"
                value="{{ $producto->nombre_producto }}">
            <br>

            <label>Descripción</label>
            <input required type="text" class="form-control" name="descripcion_producto"
                value="{{ $producto->descripcion_producto }}">
            <br>

            <label>Precio (€)</label>
            <input required type="text" class="form-control" name="precio" value="{{ $producto->precio }}">
            <br>

            <label>Contacto</label>
            <input required type="text" class="form-control" name="contacto" value="{{ $producto->contacto }}">
            <br>

            <div class="text-center">
                <a href="{{ route('compraventa_administrar') }}" class="btn btn-danger">Cancelar</a>
                <button class="btn btn-primary">Actualizar producto</button>
            </div>
        </div>
    </form>

    <script>
        function mostrar_nueva_img(e) {
            if (e.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    document.querySelector('.editar_imagen').setAttribute('src', e.target.result);
                }
                reader.readAsDataURL(e.files[0]);
            }
        }
    </script>

@endsection