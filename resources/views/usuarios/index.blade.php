@extends('adminlte::page')

@section('title', 'Glamping Nube')

@section('content_header')
@stop

@section('content')
<br>
<div class="section-box">
<h1 id="demoFont">LISTA DE USUARIO</h1>
</div>
@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif
<br>
                    @can('crear-domo')
                        <a class="btn" id="button-19" href="{{ route('usuarios.create')}}">Crear Usuario</a>
                    @endcan
                    <br> <br>
                        <table id="usuarios" class="table table-striped mt-2">

                         <thead  class="text-white"> <!--style="background-color:darkslategrey" -->
                         <th style="color:white;">Cedula</th>
                         <th style="color:white;">Nombre</th>
                         <th style="color:white;">Apellido</th>
                         <th style="color:white;">Celular</th>
                         <th style="color:white;">Estado</th>
                         <th style="color:white;">Email</th>
                         <th style="color:white;">Rol</th>
                         <th style="color:white;">Acciones</th>

                        </thead>
                         <tbody>
                             @foreach($usuarios as $usuario)
                               <tr>
                                <td >{{$usuario->usu_cedula}}</td>
                                <td>{{$usuario->name}}</td>
                                <td>{{$usuario->usu_apellido}}</td>
                                <td>{{$usuario->usu_celular}}</td>
                                <td>{{$usuario->estado}}</td>
                                <td>{{$usuario->email}}</td>
                                <td>
                                    @if(!empty($usuario->getRoleNames()))
                                    @foreach($usuario->getRoleNames() as $rolName)
                                    <h5><span class="badge badge-dark">{{$rolName}}</span></h5>
                                    @endforeach
                                    @endif
                                </td>
                                <td>    
                                <form action="{{ route('usuarios.destroy', $usuario->id)}}" method="POST">
                                    @can('editar-usuario')
                                <a class="btn btn-info" href="{{ route('usuarios.edit', $usuario->id)}}"><i class="fas fa-pen"></i></a>
                                @endcan
                                
                                @csrf
                                @method('DELETE')
                                @can('borrar-usuario')
                               <button type="submit" class="btn btn-danger" href="{{ route('usuarios.destroy', $usuario->id)}}"><i class="fas fa-trash"></i></button>
                                @endcan
                                     </form>

                                </td>
                               </tr>
                             @endforeach
                         </tbody>

                        </table>
                        

@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<style>
    thead{
        background-color: rgb(74, 220, 162); 
    }
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
/* CSS */
#button-19 {
  appearance: button;
  background-color: #37eebd;
  border-radius: 16px;
  border-width: 0 0 4px;
  box-sizing: border-box;
  color: #FFFFFF;
  cursor: pointer;
  display: inline-block;
  font-family: din-round,sans-serif;
  font-size: 15px;
  font-weight: 700;
  letter-spacing: .8px;
  line-height: 20px;
  margin: 0;
  outline: none;
  overflow: visible;
  padding: 13px 16px;
  text-align: center;
  text-transform: uppercase;
  touch-action: manipulation;
  transform: translateZ(0);
  transition: filter .2s;
  user-select: none;
  -webkit-user-select: none;
  vertical-align: middle;
  white-space: nowrap;
  width: 100%;
}

#button-19:after {
  background-clip: padding-box;
  background-color: #11efca;
  border: solid transparent;
  border-radius: 16px;
  border-width: 0 0 4px;
  bottom: -4px;
  content: "";
  left: 0;
  position: absolute;
  right: 0;
  top: 0;
  z-index: -1;
}

#button-19:main,
#button-19:focus {
  user-select: auto;
}

#button-19:hover:not(:disabled) {
  filter: brightness(1.1);
  -webkit-filter: brightness(1.1);
}

#button-19:disabled {
  cursor: auto;
}
</style>


@stop

@section('js')

<script defer src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script defer src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script defer src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script> 
$(document).ready(function() {
$('#usuarios').DataTable(
{ "language":
{
    "search": "Buscar",
    "lengthMenu": "Mostrar _MENU_ registros por página",
    "info": "Mostrando página _PAGE_ de _PAGES_",
    "paginate": {
        "previous": "Anterior",
        "next": "Siguiente",
        "first": "Primero",
        "last": "Último"
    }
}
}


);
});
</script>
<script>
    console.log('Hi!');
</script>

@stop