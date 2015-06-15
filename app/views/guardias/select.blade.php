@extends('layouts.main')

@section('title')
    Listados guardias
@stop

@section('contenido')
<h3>Proceda a hacer su selección para obtener los listados de las guardias</h3>
{{Form::open(array('url' => 'guardia/listado'))}}
{{Form::select('profesional', $profesionales)}}
{{Form::select('sede', $sedes)}}
{{ Form::text('fecha_inicio', '', array( 'class' => 'datepicker euros')) }} - {{ Form::text('fecha_fin', '', array( 'class' => 'datepicker euros')) }}
{{ Form::submit('Seleccionar', array('class'=>'botonl'))}}

{{ Form::close() }}

@yield('listado_gf')
@stop

 