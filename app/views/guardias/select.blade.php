@extends('layouts.main')

@section('title')
    Listados guardias
@stop

@section('contenido')
<h3>Proceda a hacer su selección para obtener los listados de las guardias 
    e indique un intervalo de tiempo</h3>
{{Form::open(array('url' => 'guardia/listado'))}}
{{Form::select('profesional', $profesionales)}}
{{Form::select('sede', $sedes)}}
{{ Form::text('fecha_inicio', '', array('placeholder' => 'inicio', 'class' => 'datepicker euros')) }} - {{ Form::text('fecha_fin', '', array('placeholder' => 'fin', 'class' => 'datepicker euros')) }}
{{ Form::submit('Seleccionar', array('class'=>'botonl'))}}

{{ Form::close() }}

@yield('listado_gf')
@stop

 