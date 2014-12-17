@extends('layouts.main')
 
@section('contenido')
{{ Form::open(array('url'=>'tratamientos/guardar')) }}     
    <h1>Creación de tratamientos:</h1>
    {{ Form::text('grupo', null, array('placeholder'=>'grupo')) }}
    {{ Form::text('codigo', null, array('placeholder'=>'código')) }}
    {{ Form::text('nombre', null, array('placeholder'=>'nombre')) }}
    {{ Form::text('precio', null, array('placeholder'=>'euros')) }}
    {{ Form::submit('Guardar')}}
{{ Form::close() }}
@stop
 