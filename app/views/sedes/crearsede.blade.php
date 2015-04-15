@extends('layouts.main')
 
@section('contenido')
{{ Form::open(array('url'=>'sedes')) }}     
<div class="tbl_izq">
    <h1>Creación de sedes</h1>
    {{ Form::text('nombre', null, array('placeholder'=>'nombre')) }}
    {{ Form::text('calleynum', null, array('placeholder'=>'dirección')) }}
    {{ Form::text('cp', null, array('placeholder'=>'código postal')) }}
    {{ Form::text('ciudad', null, array('placeholder'=>'ciudad')) }}
    {{ Form::text('provincia', null, array('placeholder'=>'provincia')) }}
    {{ Form::text('tel', null, array('placeholder'=>'teléfono')) }}
    {{ Form::text('mail', null, array('placeholder'=>'mail')) }}
    
    <br/>
    {{ Form::submit('Guardar sede')}}
{{ Form::close() }}
</div>
<div class="tbl_drc">
@yield('listado_sedes')
</div>
@stop
