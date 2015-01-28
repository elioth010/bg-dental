@extends('layouts.main')
 
@section('contenido')
{{ Form::open(array('url'=>'especialidad')) }}     
<div class="tbl_izq">
    <h1>Creación de Especialidades</h1>
    <ul class="labelreg4">
    <li>{{ Form::label('codigo', 'Código') }}</li>
    <li>{{ Form::label('especialidad', 'Nombre') }}</li>
    </ul>
    <ul class="labelreg3">
    <li>{{ Form::text('codigo', null) }}</li>
	<li>{{ Form::text('especialidad', null) }}</li>
    <li>{{ Form::submit('Guardar especialidad', array('class'=>'botonl'))}}</li>
		{{ Form::close() }}
	</ul>
</div>
<div class="tbl_drc">
@yield('listado_especs')
</div>
@stop
 