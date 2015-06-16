@extends('layouts.main')

@section('title')
    Crear opción
@stop

@section('contenido')
{{ Form::open(array('url'=>'opciones')) }}
<div class="tbl_izq">
    <h1>Creación de Opciones</h1>
    <ul class="labelreg4">
    <li>{{ Form::label('nombre', 'Nombre') }}</li>
    <li>{{ Form::label('valor', 'Valor') }}</li>
    <li>{{ Form::label('desc', 'Descripción') }}</li>
    </ul>
    <ul class="labelreg3">
    <li>{{ Form::text('nombre', null) }}</li>
	<li>{{ Form::text('valor', null) }}</li>
        <li>{{ Form::text('desc', null) }}</li>
        <li>Oculto: {{Form::checkbox('oculto')}}</li>
    <li>{{ Form::submit('Guardar opción', array('class'=>'botonl'))}}</li>
		{{ Form::close() }}
	</ul>
</div>
<div class="tbl_drc">
@yield('listado_opciones')
</div>
@stop
