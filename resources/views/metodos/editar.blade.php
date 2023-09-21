@extends('adminlte::page')

@section('title', 'Glamping Nube')

@section('content_header')

@stop

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page_heading">Editar Metodo De Pago</h3>
    </div>
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

                        <form action="{{ route ('metodos.update', $metodo->met_codigo) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="met_nombre">Nombre:</label>
                                        <input type="text" name="met_nombre" class="form-control" value="{{$metodo->met_nombre}}">
                                    </div>
                                </div>

                               
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    
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
@stop

@section('js')
<script>
    console.log('Hi!');
</script>
@stop