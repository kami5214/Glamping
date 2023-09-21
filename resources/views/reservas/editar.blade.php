@extends('adminlte::page')

@section('title', 'Glamping Nube')

@section('content_header')
@stop

@section('content')
<section class="section">
<br>
<div class="section-box">
<h1 id="demoFont">EDITAR RESERVA</h1>
</div>
<br> 
    <div class="section-body">
        <div class="row">
            <div class="col-Ig-12">
                <div class="card" >
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


<form action="{{ route ('reservas.update', $reserva->id) }}" method="POST" >
    @csrf
    @method('PUT')
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
    <label for="res_fecha_ini">Fecha inicio:</label>
    <input type="date" name="res_fecha_ini" class="form-control" value="{{ $reserva->res_fecha_ini }}">
</div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
    <label for="res_fecha_fin">Fecha Fin:</label>
    <input type="date" name="res_fecha_fin" class="form-control" value="{{ $reserva->res_fecha_fin }}">
</div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
    <label for="usu_cedula">Usuario:</label>
    <select class="form-control" id="usu_cedula" name="usu_cedula">
        <option value="">Seleccionar un usuario</option>
        @foreach($usuarios as $usuario)
        <option value="{{ $usuario->id }}" {{ $usuario->id == $reserva->usu_cedula ? 'selected' : '' }}>
        {{ $usuario->name }}
        @endforeach
    </select>
</div>
    </div>
    

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
        <label for="cli_cedula">Cliente:</label>
        <select class="form-control" id="cli_cedula" name="cli_cedula">
            <option value="">Seleccionar un cliente</option>
            @foreach($clientes as $cliente)
            <option value="{{ $cliente->id }}" {{ $cliente->id == $reserva->cli_cedula ? 'selected' : '' }}>
            {{ $cliente->cli_nombre }}
            @endforeach
        </select>
    </div>
        </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
    <label for="dom_codigo">Domo:</label>  
    <select class="form-control" id="dom_codigo" name="dom_codigo">
        <option value="">Seleccionar un domo</option>
        @foreach($domos as $domo)
        <option value="{{ $domo->dom_codigo }}" {{ $domo->dom_codigo == $reserva->dom_codigo ? 'selected' : '' }} data-dom_precio="{{ $domo->dom_precio }}">
        {{ $domo->dom_nombre }}
        @endforeach
    </select>
</div>
    </div>

    
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <label for="servicios">Servicios:</label>
            <br>
            @foreach ($servicios as $servicio)
            <div class="form-check">
<input class="form-check-input" type="checkbox" name="serviciosSeleccionados[]" value="{{ $servicio->ser_codigo }}" id="servicio_{{$servicio->ser_codigo}}" data-ser_precio="{{ $servicio->ser_precio }}"
{{ in_array($servicio->ser_codigo, $reserva->servicios->pluck('ser_codigo')->toArray()) ? 'checked' : '' }}>
<label class="form-check-label" for="servicio_{{ $servicio->ser_codigo }}">{{ $servicio->ser_nombre }}</label>
<br>
</div>
                @endforeach
    </div>
        </div>


    <div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
    <label for="res_cantidad_per">Cantidad personas:</label>
    <input type="number" name="res_cantidad_per" class="form-control" value="{{ $reserva->res_cantidad_per }}">
</div>
    </div>

    
    <div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
    <label for="res_descuento">Descuento:</label>
    <input type="number" name="res_descuento" class="form-control" value="{{ $reserva->res_descuento}}" id="res_descuento">
</div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
<label for="res_estado">Estado</label>
    <select class="form-control" id="res_estado" name="res_estado">
    <option value="confirmada">Confirmada</option>
    <option value="encurso">En curso</option>
    <option value="encurso">Completada</option>
    <option value="cancelada">Cancelada</option>
</select>
</div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
    <label for="res_total">Total:</label>
    <input type="number" name="res_total"  class="form-control" value="{{ $reserva->res_total}}"  readonly>
</div>
    </div>

    <input type="hidden" id="servicios" name="servicios" value="{{ implode(',', $reserva->servicios->pluck('ser_codigo')->toArray()) }}">

    <br>
    <button type="submit" class="btn btn-primary" id="guardarReserva">Actualizar Reserva</button>
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
      $('#guardarServicios').click(function () {
          // Obtener las características seleccionadas del formulario dentro del modal
          var serviciosSeleccionados = [];
          $('input[name="servicios[]"]:checked').each(function () {
            serviciosSeleccionados.push($(this).val());
          });
  
  
          // Actualiza un campo oculto en el formulario principal con las características seleccionadas
          $('#serviciosSeleccionados').val(serviciosSeleccionados);
  
  
          // Cierra el modal de características
          $('#modalServicios').modal('hide');
      });
  
  
      // Manejar el clic en el botón "Guardar Domo" en el formulario principal
      $('#guardarReserva').click(function () {
          // Enviar el formulario principal para guardar los datos del domo, incluyendo las características seleccionadas
          $('#formularioReserva').submit();
      });
  });
  </script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
$(document).ready(function() {
    function calcularTotal() {
        // Obtiene la fecha de inicio y la fecha de finalización
        var fechaInicio = new Date($("#res_fecha_ini").val());
        var fechaFin = new Date($("#res_fecha_fin").val());

        // Calcula el número de días de la reserva
        var numDias = Math.floor((fechaFin - fechaInicio) / (1000 * 60 * 60 * 24));

        // Obtiene el costo del domo seleccionado
        var precioDomo = parseFloat($("#dom_codigo option:selected").data("dom_precio")) || 0;

        // Obtiene el costo de los servicios seleccionados
        var precioServicios = 0;
        $("input[name='serviciosSeleccionados[]']:checked").each(function() {
            precioServicios += parseFloat($(this).data("ser_precio")) || 0;
        });

        // Obtiene el descuento
        var descuento = parseFloat($("#res_descuento").val()) || 0;

        // Calcula el costo total sin descuento
        var costoTotalSinDescuento = (precioDomo + precioServicios) * numDias;

        // Aplica el descuento
        var costoTotalConDescuento = costoTotalSinDescuento - descuento;

        // Actualiza el campo de total en el formulario
        $("#res_total").val(costoTotalConDescuento);
    }

    // Llama a la función de cálculo cuando cambian los valores
    $("#res_fecha_ini, #res_fecha_fin, #dom_codigo, input[name='serviciosSeleccionados[]'], #res_descuento").change(calcularTotal);

    // Calcula el total inicial
    calcularTotal();
});
</script>

@stop