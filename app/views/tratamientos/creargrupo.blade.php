@extends('layouts.main')
 
@section('contenido')
{{ Form::open(array('url'=>'tratamientos/guardargrupo')) }}     
    <h1>Creación de grupos de tratamientos:</h1>
    {{ Form::text('nombre', null, array('placeholder'=>'nombre')) }}
    {{ Form::text('codigo', null, array('placeholder'=>'código')) }}
    {{ Form::submit('Guardar grupo')}}
{{ Form::close() }}
@yield('listado_grps')
@stop
 