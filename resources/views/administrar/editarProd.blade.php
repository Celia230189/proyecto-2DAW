@extends('index')

@section('contenido_principal')
<style>
    /* ESTILOS LOCALES */
    .div_editar {
        width: 25%;
        margin-left: 37%;
    }

    .input_imagen > input {
        display: none;
    }

    .editar_imagen {
        position: relative;
        width: 80%;
    }

    #boton_cancelar {
        margin-left: 40%;
    }

    #boton_guardar {
        position: absolute;
        margin-left: 2%;
    }

    #logo {
        width: 120px;
        margin-left: 42%;
        padding-bottom: 2%;
    }
</style>

<div class="">
            <h1 class="text-center">Editando: {{$producto->titulo}}</h1>
        
        <form id="confirmar" action="{{route('confirmarCambios', $producto->id)}}" method="post" enctype="multipart/form-data">
            @csrf

                {{-- Input imagen principal --}}
                <div  class="div_editar_img text-center">
                    <div class="input_imagen">
                        <label for="file-input-main">
                          <img class="editar_imagen img-responsive" src="{{asset($producto->imagen)}}"/>
                        </label>
                        {{-- Se usa 'file-input-main' como ID para evitar conflictos --}}
                        <input onchange="mostrar_nueva_img(this)" id="file-input-main" type="file" name="nueva_imagen"/>
                      </div><br>
                </div>
                
                {{-- Input Titulo --}}
                <div class="div_editar">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">Titulo</span>
                        </div>
                        <input type="text" class="form-control" name="titulo" value="{{$producto->titulo}}">
                        </div>
                    </div><br> 
                </div> 

                {{-- Input Descripcion --}}
                <div class="div_editar">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">Descripcion</span>
                        </div>
                        {{-- Usamos <textarea> para la descripción larga --}}
                        <textarea class="form-control" name="descripcion">{{$producto->descripcion}}</textarea>
                        </div>
                    </div><br>
                </div>

                {{-- Input Precio --}}
                <div class="div_editar">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">Precio</span>
                        </div>
                        {{-- Usamos type="number" y step="0.01" para el decimal --}}
                        <input type="number" step="0.01" class="form-control" name="precio" value="{{$producto->precio}}">
                        <div class="input-group-append">
                        <span class="input-group-text">€</span>
                        </div>
                    </div><br>
                </div>

                {{-- Input Tipo --}}
                <div class="div_editar">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">Tipo</span>
                        </div>
                        <select name="tipo" class="form-control" id="tipo">
                            {{-- Esto asegura que la opción actual esté seleccionada --}}
                            @foreach(['ropa', 'calzado', 'complementos'] as $opcion)
                                <option value="{{ $opcion }}" @if($producto->tipo === $opcion) selected @endif>
                                    {{ ucfirst($opcion) }}
                                </option>
                            @endforeach
                        </select>
                    </div><br>
                </div>

                {{-- Input Categoria Prenda --}}
                <div class="div_editar">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">Categoria</span>
                        </div>
                        <select name="categoria_prenda" class="form-control" required id="categoria_prenda">
                            {{-- Opción actual --}}
                            <option value="{{ $producto->categoria_prenda }}" selected>
                                {{ ucfirst($producto->categoria_prenda) }} (Actual)
                            </option>
                            {{-- Opciones de Ropa --}}
                            <option value="sudadera con capucha">Sudadera con capucha</option>
                            <option value="camiseta">Camiseta</option>
                            <option value="falda">Falda</option>
                            {{-- Opciones de Calzado --}}
                            <option value="zapatillas">Zapatillas</option>
                            <option value="zapato de vestir">Zapato de vestir</option>
                            {{-- Opciones de Complementos --}}
                            <option value="anillo">Anillo</option>
                            <option value="gorra">Gorra</option>
                        </select>
                    </div><br>
                </div>

                {{-- Input Marca --}}
                <div class="div_editar">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">Marca</span>
                        </div>
                        <input type="text" class="form-control" name="marca" value="{{$producto->marca}}">
                    </div><br>
                </div>

                {{-- Input Genero --}}
                <div class="div_editar">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">Genero</span>
                        </div>
                        <select name="genero" class="form-control" id="genero">
                            @foreach(['masculino', 'femenino', 'unisex'] as $opcion)
                                <option value="{{ $opcion }}" @if($producto->genero === $opcion) selected @endif>
                                    {{ ucfirst($opcion) }}
                                </option>
                            @endforeach
                        </select>
                    </div><br>
                </div>

                {{-- Inputs img2, img3, img4 --}}
                <div class="div_editar">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">Imagen 2</span>
                        </div>
                        <input type="file" class="form-control" name="img2">
                        </div>
                    </div><br>
                </div>

                <div class="div_editar">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">Imagen 3</span>
                        </div>
                        <input type="file" class="form-control" name="img3">
                        </div>
                    </div><br>
                </div>

                <div class="div_editar">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">Imagen 4</span>
                        </div>
                        <input type="file" class="form-control" name="img4">
                        </div>
                    </div><br>
                </div>
                            
                <br>
                <div>
                    <a href="{{route('administrar')}}"><input type="button" id="boton_cancelar" class="btn btn-danger" value="Cancelar"></a>
                    <button id="boton_guardar" class="btn btn-info">Guardar</button>
                </div>
            </form>
        </div>
        <div style="height: 40px;"></div>
    <script>
        function mostrar_nueva_img(e) {
            if (e.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.querySelector('.editar_imagen').setAttribute('src', e.target.result);
                }
                reader.readAsDataURL(e.files[0]);
            }
        }
    </script>

@endsection