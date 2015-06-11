@extends('layouts.main')

@section('title')
    Editar especialidad
@stop

@section('contenido')
{{ Form::open(array('url'=>'especialidad/'.$especialidad->id, 'method' => 'put')) }}
<div class="tbl_izq">
    <h1>Edición de Especialidad</h1>
    <ul class="labelreg4">
    <li>{{ Form::label('codigo', 'Código') }}</li>
    <li>{{ Form::label('especialidad', 'Nombre') }}</li>
    </ul>
    <ul class="labelreg3">
    <li>{{ Form::text('codigo', $especialidad->codigo) }}</li>
	<li>{{ Form::text('especialidad', $especialidad->especialidad) }}</li>
    <li>{{ Form::submit('Actualizar especialidad', array('class'=>'botonl'))}}</li>
		{{ Form::close() }}
	</ul>
</div>
<div class="tbl_drc">
@yield('listado_especs')
</div>
@stop
