@extends('layouts.main')
 
@section('contenido')
{{ Form::open(array('url'=>'pacientes/busqueda')) }}     
    <h1>Búsqueda de pacientes:</h1>
    
    {{ Form::text('nombre', null, array('placeholder'=>'Texto a buscar o NHC')) }}
    
   <!-- {{ Form::text('apellido2', null, array('placeholder'=>'Segundo apellido')) }}-->
    {{ Form::submit('Buscar')}}
{{ Form::close() }}
@stop
 