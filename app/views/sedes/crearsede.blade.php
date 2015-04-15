@extends('layouts.main')
 
@section('contenido')
{{ Form::open(array('url'=>'sede')) }}     
<div class="tbl_izq">
    <h1>Creación de sedes</h1>
    <ul class="labelreg3">
        <li>{{ Form::text('nombre', null, array('placeholder'=>'nombre')) }}</li>
        <li>{{ Form::text('calleynum', null, array('placeholder'=>'dirección')) }}</li>
        <li>{{ Form::text('cp', null, array('placeholder'=>'código postal')) }}</li>
        <li>{{ Form::text('ciudad', null, array('placeholder'=>'ciudad')) }}</li>
        <li>{{ Form::text('provincia', null, array('placeholder'=>'provincia')) }}</li>
        <li>{{ Form::text('tel', null, array('placeholder'=>'teléfono')) }}</li>
        <li>{{ Form::text('mail', null, array('placeholder'=>'mail')) }}</li>
    </ul>
    <br/>
    {{ Form::submit('Guardar sede')}}
{{ Form::close() }}
</div>
<div class="tbl_drc">
@yield('listado_sedes')
</div>
@stop
