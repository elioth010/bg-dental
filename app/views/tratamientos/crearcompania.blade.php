@extends('layouts.main')
 
@section('contenido')
{{ Form::open(array('url'=>'tratamientos/guardarcompania')) }}     
<div class="tbl_izq">
    <h1>Creación de compañías</h1>
    {{ Form::text('nombre', null, array('placeholder'=>'nombre')) }}
    {{ Form::text('codigo', null, array('placeholder'=>'código')) }}
    <br/>{{ Form::textarea('comentarios', null, array('placeholder'=>'comentarios')) }}
    <br/>
    {{ Form::submit('Guardar compañía')}}
{{ Form::close() }}
</div>
<div class="tbl_drc">
@yield('listado_comps')
</div>
@stop
 