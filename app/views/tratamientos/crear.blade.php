@extends('layouts.main')
 
@section('contenido')
{{ Form::open(array('url'=>'tratamientos/guardar')) }}     
    <h1>Creación de tratamientos:</h1>
    {{ Form::select('grupostratamientos_id', $grupos) }}
    {{ Form::text('codigo', null, array('placeholder'=>'código')) }}
    {{ Form::text('nombre', null, array('placeholder'=>'nombre')) }}
    {{ Form::text('precio_base', null, array('placeholder'=>'euros')) }}
    General? {{ Form::checkbox('tipostratamientos_id') }}
    {{ Form::submit('Guardar')}}

{{ Form::close() }}
@stop
 