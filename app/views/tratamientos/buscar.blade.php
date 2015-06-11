@extends('layouts.main')
 
@section('contenido')

{{ Form::open(array('url'=>'tratamientos/busqueda')) }}     
    <h1>Búsqueda de tratamientos</h1>
    {{ Form::text('nombre', null, array('placeholder'=>'Nombre')) }}
    {{ Form::text('codigo', null, array('placeholder'=>'Código Quirón')) }}
    {{ Form::submit('Buscar')}}
{{ Form::close() }}

@stop
