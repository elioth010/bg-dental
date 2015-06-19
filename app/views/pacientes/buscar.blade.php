@extends('layouts.main')

@section('title')
    Pacientes
@stop

@section('contenido')
{{ Form::open(array('url'=>'paciente/busqueda')) }}
    <h1>Búsqueda de pacientes:</h1>

    {{ Form::text('nombre', null, array('placeholder'=>'Texto a buscar o NHC', 'autofocus' => '')) }}

   <!-- {{ Form::text('apellido2', null, array('placeholder'=>'Segundo apellido')) }}-->
    {{ Form::submit('Buscar', array('class'=>'botonl'))}}
{{ Form::close() }}
@stop
