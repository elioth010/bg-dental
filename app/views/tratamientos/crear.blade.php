@extends('layouts.main')
 
@section('contenido')
{{ Form::open(array('url'=>'tratamientos/guardar')) }}     
    <h1>Creación de tratamientos:</h1>
    <ul class="labelreg6">
    <li>{{ Form::select('grupostratamientos_id', $grupos) }}</li>
    <li>{{ Form::text('codigo', null, array('placeholder'=>'código')) }}</li>
    <li>{{ Form::text('nombre', null, array('placeholder'=>'nombre')) }}</li>
    <li>{{ Form::text('precio_base', null, array('placeholder'=>'euros')) }}</li>
    General? {{ Form::checkbox('tipostratamientos_id') }}
    <li>{{Form::hidden('activo', '1')}}</li>
    <li>{{ Form::submit('Guardar', array('class'=>'botonl'))}}</li>

{{ Form::close() }}
@stop
 	</ul>