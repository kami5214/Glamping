@extends('adminlte::page')
@section('title', 'Glamping Nube')

@section('content_header')
<div class="section-box" >
    <div class="section-body">
<h1 id="demoFont">Hola, {{ Auth::user()->name }}</h1>
<h2 id="demoFont">Bienvenido al Sistema de Glamping Nube</h2>
    </div>
</div>
@stop

@section('content')

<div class="row">
    <div class="col-md-4" >
        <div class="card" id="usuarios">
            <div class="card-body d-flex text-white" id="titulos"> 
                Usuarios
                <i class="fas fa-user fa-2x ml-auto"></i>
            </div>
            @php 
            use App\Models\User; 
            $cant_User = User::count();
            @endphp
            <div class="card-footer d-flex aling-items-center justify-content-between">
                <a href="/usuarios" class="text-white">Ver detalles</a>
                <h2 class="text-right"><span id="numeros">{{$cant_User}}</span></h2>
            </div>

        </div>
    </div>
    <div class="col-md-4">
        <div class="card" id="reservas">
            <div class="card-body d-flex text-white" id="titulos">
                Reservas
                <i class="fas fa-calendar fa-2x ml-auto"></i>
            </div>
            @php 
            use App\Models\reserva; 
            $cant_Reserva = reserva::count();
            @endphp
            <div class="card-footer d-flex aling-items-center justify-content-between">
                <a href="/reservas" class="text-white">Ver detalles</a>
                <h2 class="text-right"><span id="numeros">{{$cant_Reserva}}</span></h2>
            </div>

        </div>
    </div>
    <div class="col-md-4">
        <div class="card" id="domos">
            <div class="card-body d-flex text-white" id="titulos">
                Domos
                <i class="fas fa-igloo fa-2x ml-auto"></i>
            </div>
            @php 
            use App\Models\Domo; 
            $cant_Domo = Domo::count();
            @endphp
            <div class="card-footer d-flex aling-items-center justify-content-between">
                <a href="/domos" class="text-white">Ver detalles</a>
                <h2 class="text-right"><span id="numeros">{{$cant_Domo}}</span></h2>
            </div>

        </div>
    </div>
</div>

<main>
    <div class="section-box" >
        <div class="section-body">
            <p>Este sistema te proporciona las herramientas necesarias para gestionar eficazmente nuestras exclusivas estancias en domos de lujo.</p>
            <p>Desde aquí, podrás realizar un seguimiento de las reservas, gestionar la disponibilidad de domos, acceder a la información de los </p>
            <p>clientes y generar informes importantes para el funcionamiento de nuestro negocio.</p>
            <p>Si tienes alguna pregunta o necesitas ayuda, no dudes en ponerte en contacto con el equipo de soporte.</p>
            <p>¡Gracias por ser parte de Glamping Nube y por tu dedicación para hacer de cada estancia una experiencia inolvidable para nuestros clientes!</p>
        </div>
    </div>
</main>


@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<style>
    .main {
    padding: 20px; /* Espaciado alrededor del contenido */
}

.section-box {
    text-align:center;
    border: 1px solid #ffffff; /* Borde alrededor del cuadro */
    padding: 20px; /* Espaciado interno del cuadro */
    border-radius: 10px; /* Borde redondeado */
    background-color: #ffffff; /* Color de fondo del cuadro */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Sombra suave */
}

#domos {
    background-color: rgb(104, 255, 217); 
}
#reservas {
    background-color: rgb(104, 255, 195); 
}
#usuarios {
    background-color: rgb(98, 227, 188); 
}
#titulos {
    font-family: "Arial Black", Gadget, sans-serif;
font-size: 24px;
letter-spacing: 0.2px;
word-spacing: 2px;
}

#demoFont {
font-family: "Arial Black", Gadget, sans-serif;
font-size: 33px;
letter-spacing: 0.2px;
word-spacing: 2px;
background-image: linear-gradient(to left, #11bc88, #a4ffe3);
color: transparent;
background-clip: text;
-webkit-background-clip: text;
font-weight: 400;
text-decoration: none solid rgb(68, 68, 68);
font-style: normal;
font-variant: normal;
text-transform: none;
}
.section-body {
    line-height: 1.6; /* Espacio entre líneas del texto */
}
#numeros{
    font-family: Impact, Charcoal, sans-serif;
font-size: 29px;
letter-spacing: 0.2px;
word-spacing: 2px;
color: #ffffff;
font-weight: 350;
text-decoration: none solid rgb(255, 255, 255);
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


