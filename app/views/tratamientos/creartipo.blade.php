@extends('layouts.main')

@section('title')
    Tipos de tratamientos
@stop

@section('contenido')
{{ Form::open(array('url'=>'tipos')) }}
<div class="tbl_izq">
    <h1>Creación de tipos de tratamientos</h1>
    {{ Form::text('tipo', null, array('placeholder'=>'tipo')) }}
    {{Form::hidden('id',)

    {{ Form::submit('Guardar tipo de tratamientos')}}
{{ Form::close() }}
</div>
<div class="tbl_drc">
@yield('listado_tipos')
</div>
@stop
