@extends('layouts.main')
 
@section('contenido')
{{ Form::open(array('url'=>'especialidad')) }}     
<div class="tbl_izq">
    <h1>Creación de Especialidades</h1>
    {{ Form::label('codigo', 'Código') }}
    {{ Form::text('codigo', null) }}
    {{ Form::label('especialidad', 'Nombre') }}
    {{ Form::text('especialidad', null) }}
    </br>
    {{ Form::submit('Guardar especialidad')}}
{{ Form::close() }}
</div>
<div class="tbl_drc">
@yield('listado_especs')
</div>
@stop
 