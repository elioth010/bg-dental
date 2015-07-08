@extends('layouts.main')

@section('title')
    Editar grupo
@stop

@section('javascripts')
<script src="/js/bgdental.js"></script>
@stop

@section('contenido')
{{ Form::open(array('url'=>'tratamientos/actualizargrupo/'.$grupo->id)) }}
<div class="tbl_izq">
    <h1>Edición de Grupo</h1>
    <ul class="labelreg4">
        <li>{{ Form::label('nombre', 'Nombre') }}</li>
        <li>{{ Form::label('codigo', 'Código') }}</li>
    </ul>
    <ul class="labelreg3">
        <li>{{ Form::text('nombre', $grupo->nombre) }}</li>
        <li>{{ Form::text('codigo', $grupo->codigo) }}</li>
	<li>{{ Form::submit('Actualizar grupo', array('class'=>'botonl'))}}</li>
		{{ Form::close() }}
    <li>{{ Form::open(array('url'=>'tratamientos/eliminargrupo/'.$grupo->id, 'onsubmit' => 'return confirm_eliminar();')) }}
    {{ Form::submit('Eliminar este grupo', array('class'=>'botonl'))}}

    {{ Form::close() }}
    </li>
	</ul>
</div>
<div class="tbl_drc">
@yield('listado_especs')
</div>
@stop
