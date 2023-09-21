@extends('adminlte::page')

@section('title', 'Glamping Nube')

@section('content_header')
@stop
@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <span class="card-title">{{ __('Ver') }} Reserva</span>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-primary" href="{{ route('reservas.index') }}"> {{ __('Volver') }}</a>
                    </div>
                </div>

                <div class="card-body">

                    
                    <div class="form-group">
                        <strong>Fecha inicio:</strong>
                        {{ $reserva->res_fecha_ini }}
                    </div>

                    <div class="form-group">
                        <strong>Fecha fin:</strong>
                        {{ $reserva->res_fecha_fin }}
                    </div>

                    <div class="form-group">
                        <strong>Fecha Registro:</strong>
                        {{ $reserva->res_fecha_registro }}
                    </div>

                    <div class="form-group">
                        <strong>Usuario:</strong>
                        {{ $reserva->usuario->name }}
                    </div>

                    <div class="form-group">
                        <strong>Cliente:</strong>
                        {{ $reserva->cliente->cli_nombre }} {{ $reserva->cliente->cli_apellido }}
                    </div>

                    <div class="form-group">
                        <strong>Domo:</strong>
                        {{ $reserva->domo->dom_nombre }}
                    </div>

                    <div class="form-group">
                        <strong>Servicios:</strong>
                        @foreach ($reserva->servicios as $servicio)
                            {{ $servicio->ser_nombre }}
                        @endforeach
                    </div>

                    <div class="form-group">
                        <strong>Cantidad de personas:</strong>
                        {{ $reserva->res_cantidad_per }}
                    </div>

                    <div class="form-group">
                        <strong>Descuento:</strong>
                        {{ $reserva->res_descuento }}
                    </div>

                    <div class="form-group">
                        <strong>Total:</strong>
                        {{ $reserva->formattedPrice }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@stop
@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    console.log('Hi!');
</script>
@stop