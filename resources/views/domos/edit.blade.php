@extends('adminlte::page')


@section('title', 'Glamping Nube')


@section('content_header')


@stop  


@section('content')
<section class="section">
<br>
<div class="section-box">
<h1 id="demoFont">EDITAR DOMO</h1>
</div>
<br> 
    <div class="section-body">
        <div class="row">
            <div class="col-Ig-12">
                <div class="card">
                    <div class="card-body">


                        @if($errors->any())
                        <div class="alert alert-dark alert-dismissible fade show" role="alert">
                            <strong>!Revise los campos!</strong>
                            @foreach($errors->all() as $error)
                            <span class="badge badge-danger">{{$error}}</span>
                            @endforeach
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif


                        <form id="formularioDomo" action="{{ route ('domos.update', $domo->dom_codigo) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="dom_nombre">Nombre:</label>
                                        <input type="text" class="form-control" id="dom_nombre" name="dom_nombre" value="{{ $domo->dom_nombre }}" required>
                                    </div>
                                    </div>




                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="dom_ubicacion">Ubicación:</label>
                                        <input type="text" class="form-control" id="dom_ubicacion" name="dom_ubicacion" value="{{ $domo->dom_ubicacion }}" required>
                                    </div>
                                </div>


                               <!-- <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="dom_estado">Estado:</label>
                                        <select class="form-control" id="dom_estado" name="dom_estado">
                                            <option value="activo">Activo</option>
                                            <option value="inactivo">Inactivo</option>
                                        </select>
                                    </div>
                                </div>-->
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="dom_estado">Estado:</label>
                                        <select class="form-control" id="dom_estado" name="dom_estado">
                                            <option value="activo" {{ $domo->dom_estado == 'activo' ? 'selected' : '' }}>Activo</option>
                                            <option value="inactivo" {{ $domo->dom_estado == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                                        </select>
                                    </div>
                                </div>
                               


                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="dom_precio">Precio:</label>
                                        <input type="number" class="form-control" id="dom_precio" name="dom_precio" value="{{ $domo->dom_precio }}" required>
                                    </div>
                                </div>
                             
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="dom_descripcion">Descripcion:</label>
                                        <input type="text" class="form-control" id="dom_descripcion" name="dom_descripcion" value="{{ $domo->dom_descripcion }}" required>
                                    </div>
                                </div>


                                <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                        <label for="dom_capacidad">Capacidad:</label>
                                        <input type="number" class="form-control" id="dom_capacidad" name="dom_capacidad" value="{{ $domo->dom_capacidad }}" required>
                                    </div>
                                </div>


                                <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="caracteristicas">Características:</label><br>
                                    @foreach ($caracteristicas as $caracteristica)
                                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="caracteristicasSeleccionadas[]" value="{{ $caracteristica->car_codigo }}" id="caracteristica_{{$caracteristica->car_codigo}}"
                        {{ in_array($caracteristica->car_codigo, $domo->caracteristicas->pluck('car_codigo')->toArray()) ? 'checked' : '' }}>
                        <label class="form-check-label" for="caracteristica_{{ $caracteristica->car_codigo }}">{{ $caracteristica->car_nombre }}</label><br>
                    </div>              
                        @endforeach

                            </div>
                                </div>
                                <input type="hidden" id="caracteristicas" name="caracteristicas" value="{{ implode(',', $domo->caracteristicas->pluck('car_codigo')->toArray()) }}">


                                <!--<input type="hidden" id="caracteristicasSeleccionadas" name="caracteristicasSeleccionadas" value="">-->
                                <button type="submit" class="btn btn-primary" id="guardarDomo">Actualizar Domo</button>
                                <!--<button type="submit" class="btn btn-primary">Guardar</button>-->
                                    <!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCaracteristicas">
                                        Editar Características
                                    </button>-->
                   
                                    <br>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop


@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<style>

    .section-box {
    text-align:center;
    border: 1px solid #ffffff; /* Borde alrededor del cuadro */
    padding: 20px; /* Espaciado interno del cuadro */
    border-radius: 10px; /* Borde redondeado */
    background-color: #ffffff; /* Color de fondo del cuadro */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Sombra suave */
}
#demoFont {
font-family: "Arial Black", Gadget, sans-serif;
font-size: 33px;
letter-spacing: 0.2px;
word-spacing: 2px;
background-image: linear-gradient(to left, #11d298, #a4ffe3);
color: transparent;
background-clip: text;
-webkit-background-clip: text;
font-weight: 400;
text-decoration: none solid rgb(68, 68, 68);
font-style: normal;
font-variant: normal;
text-transform: none;
}
</style>
@stop


@section('js')
<script>
    console.log('Hi!');
</script>
<script>
  $(document).ready(function () {
    // Manejar el clic en el botón "Guardar Características" dentro del modal
    $('#guardarCaracteristicas').click(function () {
        // Obtener las características seleccionadas del formulario dentro del modal
        var caracteristicasSeleccionadas = [];
        $('input[name="caracteristicas[]"]:checked').each(function () {
            caracteristicasSeleccionadas.push($(this).val());
        });


        // Actualiza un campo oculto en el formulario principal con las características seleccionadas
        $('#caracteristicasSeleccionadas').val(caracteristicasSeleccionadas);


        // Cierra el modal de características
        $('#modalCaracteristicas').modal('hide');
    });


    // Manejar el clic en el botón "Guardar Domo" en el formulario principal
    $('#guardarDomo').click(function () {
        // Enviar el formulario principal para guardar los datos del domo, incluyendo las características seleccionadas
        $('#formularioDomo').submit();
    });
});


</script>
@stop
