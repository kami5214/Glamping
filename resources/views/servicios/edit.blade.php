@extends('adminlte::page')

@section('title', 'Glamping Nube')

@section('content_header')

@stop

@section('content')
<section class="section">
<br>
<div class="section-box">
<h1 id="demoFont">EDITAR SERVICIO</h1>
</div>
<br> 
    <div class="section-body">
        <div>
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

                        <form action="{{ route ('servicios.update', $servicio->ser_codigo) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="ser_nombre">Nombre:</label>
                                        <input type="text" class="form-control" id="ser_nombre" name="ser_nombre" value="{{ $servicio->ser_nombre }}" required> 
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="ser_estado">Estado:</label>
                                        <select class="form-control" id="ser_estado" name="ser_estado">
                                            <option value="activo">Activo</option>
                                            <option value="inactivo">Inactivo</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="ser_precio">Precio:</label>
                                        <input type="number" class="form-control" id="ser_precio" name="ser_precio" value="{{ $servicio->ser_precio }}" required>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="ser_cantidad">Cantidad:</label>
                                        <input type="number" class="form-control" id="ser_cantidad" name="ser_cantidad" value="{{ $servicio->ser_cantidad }}" required>
                                    </div>

                                    <br>
                                    <button type="submit" class="btn btn-primary">Guardar</button>
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
@stop