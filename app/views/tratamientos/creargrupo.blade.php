@extends('layouts.main')

@section('title')
    Grupos de tratamientos
@stop

@section('contenido')
{{ Form::open(array('url'=>'tratamientos/guardargrupo')) }}
    <h1>Creación de grupos de tratamientos:</h1>
    <ul class="labelreg3">
    	<li>{{ Form::text('nombre', null, array('placeholder'=>'nombre')) }}</li>
    	<li>{{ Form::text('codigo', null, array('placeholder'=>'código')) }}</li>
    	<li>{{ Form::submit('Guardar grupo', array('class'=>'botonl'))}}</li>
{{ Form::close() }}
	</ul>
	<div class="roll">
@yield('listado_grps')
	</div>
@stop
