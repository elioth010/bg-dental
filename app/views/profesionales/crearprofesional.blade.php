@extends('layouts.main')
 
@section('contenido')
{{ Form::open(array('url'=>'profesional')) }}     
<div class="tbl_izq">
    <h1>Creación de profesionales</h1>
    {{ Form::text('nombre', null, array('placeholder'=>'nombre')) }}
    {{ Form::text('apellido1', null, array('placeholder'=>'apellido1')) }}
    {{ Form::text('apellido2', null, array('placeholder'=>'apellido2')) }}
    {{ Form::select('especialidades_id', $especialidades, null) }}
    </br>
    {{ Form::submit('Guardar profesional')}}
{{ Form::close() }}
</div>
<div class="tbl_drc">
@yield('listado_profs')
</div>
@stop
 