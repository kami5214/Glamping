@extends('adminlte::page')

@section('title', 'Glamping Nube')

@section('content_header')

@stop

@section('content')
<section class="section">
<br>
<div class="section-box">
<h1 id="demoFont">VIDEO DE IMPLEMENTACION Y MANUAL DE USUARIO</h1>
</div>
<br> 
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