@extends('adminlte::page')

@section('title', 'Glamping Nube')

@section('content_header')

@stop

@section('content')
<section class="section">
<br>
<div class="section-box">
<h1 id="demoFont">EDITAR CLIENTE</h1>
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

                        <form action="{{ route ('clientes.update', $cliente->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="cli_cedula">Cedula:</label>
                                        <input type="number" name="cli_cedula" class="form-control" value="{{$cliente->cli_cedula}}">
                                        @error('cli_cedula')
<small style="color:red">{{ $message }}</small>
@enderror
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="cli_nombre">Nombre:</label>
                                        <input type="text" name="cli_nombre" class="form-control" value="{{$cliente->cli_nombre}}">
                                        @error('cli_nombre')
<small style="color:red">{{ $message }}</small>
@enderror
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="cli_apellido">Apellido:</label>
                                        <input type="text" name="cli_apellido" class=" form-control" value="{{$cliente->cli_apellido}}">
                                        @error('cli_apellido')
<small style="color:red">{{ $message }}</small>
@enderror
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="cli_correo">Correo:</label>
                                        <input type="email" name="cli_correo" class="form-control" value="{{$cliente->cli_correo}}">
                                        @error('cli_correo')
<small style="color:red">{{ $message }}</small>
@enderror
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="cli_celular">Celular:</label>
                                        <input type="number" name="cli_celular" class="form-control" value="{{$cliente->cli_celular}}">
                                        @error('cli_celular')
<small style="color:red">{{ $message }}</small>
@enderror
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="cli_ciudad">Ciudad:</label>
                                        <input type="text" name="cli_ciudad" value="{{$cliente->cli_ciudad}}"></input>
                                        @error('cli_ciudad')
<small style="color:red">{{ $message }}</small>
@enderror 
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="cli_estado">Estado:</label>
                                        <select class="form-control" name="cli_estado" value="{{$cliente->cli_estado}}">
                                            <option value="activo">Activo</option>
                                            <option value="inactivo">Inactivo</option>
                                        </select>
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