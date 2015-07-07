@extends('layouts.main')

@section('title')
    Editar compañía
@stop

@section('javascripts')
<script src="/js/bgdental.js"></script>
@stop


@section('contenido')
    <h1>Edición de compañía</h1>

    {{ Form::open(array('url'=>'tratamientos/modificarcompania/'.$compania->id)) }}

	<ul class="labelreg6" style="margin-bottom:10px;">
       <li> {{Form::label('Código:')}} {{ Form::text('codigo', $compania->codigo ) }}
        {{Form::label('Nombre:')}} {{ Form::text('nombre', $compania->nombre) }}</li>
    </ul>
     <br>{{ HTML::linkAction('CompaniasController@destroy', 'Eliminar esta compañía', $compania->id, array('onclick' => 'return confirm_eliminar();')) }}<br>
    {{ Form::submit('Guardar cambios', array('class'=>'botonl'))}}

    {{ Form::close() }}




@stop
