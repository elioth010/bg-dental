@extends('layouts.main')

@section('title')
    Tratamientos
@stop

@section('contenido')

{{ Form::open(array('url'=>'tratamientos/busqueda')) }}
    <h1>Búsqueda de tratamientos</h1>
    {{ Form::text('nombre', null, array('placeholder'=>'Nombre', 'autofocus' => '')) }}
    {{ Form::text('codigo', null, array('placeholder'=>'Código Quirón')) }}
    {{ Form::submit('Buscar')}}
{{ Form::close() }}

@stop
