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
</style>

<div class="">
            <h1 class="text-center">Añadir Nuevo Producto</h1>
        
        <form id="confirmar" action="{{route('nuevoProd')}}" method="POST" enctype="multipart/form-data">
            @csrf

                {{-- Input imagen principal --}}
                <div class="div_editar_img text-center">
                    <div class="input_imagen">
                        <label for="file-input">
                          <img class="editar_imagen img-responsive" src="{{asset('img/productos/default.jpg')}}"/>
                        </label>
                        <input onchange="mostrar_nueva_img(this)" id="file-input" type="file" name="nueva_imagen" required/>
                      </div><br>
                </div>
                
                {{-- Input Titulo --}}
                <div class="div_editar">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">Titulo</span>
                        </div>
                        <input required type="text" class="form-control" name="titulo" value="{{ old('titulo') }}">
                        </div>
                    </div><br> 
                </div> 

                {{-- Input Descripcion --}}
                <div class="div_editar">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">Descripcion</span>
                        </div>
                        {{-- CORREGIDO: Usamos <textarea> para la descripción larga --}}
                        <textarea required class="form-control" name="descripcion">{{ old('descripcion') }}</textarea>
                        </div>
                    </div><br>
                </div>

                {{-- Input Precio --}}
                <div class="div_editar">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">Precio</span>
                        </div>
                        {{-- CORREGIDO: Usamos type="number" step="0.01" para DECIMAL --}}
                        <input required type="number" step="0.01" class="form-control" name="precio" value="{{ old('precio') }}">
                        <div class="input-group-append">
                        <span class="input-group-text">€</span>
                        </div>
                    </div><br>
                </div>

                {{-- Input Tipo (Ropa, Calzado...) --}}
                <div class="div_editar">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">Tipo</span>
                        </div>
                        <select required name="tipo" class="form-control" id="tipo">
                            <option value="">Seleccionar</option>
                            @foreach(['ropa', 'calzado', 'complementos'] as $opcion)
                                <option value="{{ $opcion }}" @if(old('tipo') === $opcion) selected @endif>
                                    {{ ucfirst($opcion) }}
                                </option>
                            @endforeach
                        </select>
                    </div><br>
                </div>

                {{-- Input Marca --}}
                <div class="div_editar">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">Marca</span>
                        </div>
                        <input required type="text" class="form-control" name="marca" value="{{ old('marca') }}">
                        </div>
                    </div><br>
                </div>

                {{-- Input Genero --}}
                <div class="div_editar">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">Genero</span>
                        </div>
                        <select required name="genero" class="form-control" id="genero">
                            <option value="">Seleccionar</option>
                            @foreach(['masculino', 'femenino', 'unisex'] as $opcion)
                                <option value="{{ $opcion }}" @if(old('genero') === $opcion) selected @endif>
                                    {{ ucfirst($opcion) }}
                                </option>
                            @endforeach
                        </select>
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