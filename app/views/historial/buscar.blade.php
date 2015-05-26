@extends('layouts.main')
 
@section('contenido')
{{ Form::open(array('url'=>'historial_clinico/busqueda')) }}     
    <h1>Busque un paciente para acceder a su historial clínico:</h1>
    
    {{ Form::text('nombre', null, array('placeholder'=>'Texto a buscar o NHC')) }}
    
   <!-- {{ Form::text('apellido2', null, array('placeholder'=>'Segundo apellido')) }}-->
    {{ Form::submit('Buscar', array('class'=>'botonl'))}}
{{ Form::close() }}
@stop
 