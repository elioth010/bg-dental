@extends('layouts.main')
 
@section('contenido')
    <h1>Ficha del tratamiento</h1>
    @foreach($tratamientos as $tratamiento)
{{ Form::open(array('url'=>'tratamientos/$tratamiento->id/editartratamiento')) }}     
    
    Código:
    {{ Form::text('codigo', null, array('placeholder'=>$tratamiento->codigo)) }}
    {{ Form::text('nombre', null, array('placeholder'=>$tratamiento->nombre)) }}<p>
    @foreach($tcp as $tcp)<li>
    {{$tcp['nombre_comp'].": "}}
    {{ Form::text('nombre', null, array('placeholder'=>$tcp['precio'])) }}</li><br>
    @endforeach
    
    {{ Form::submit('Guardar cambios')}}
    {{ Form::button('Atrás')}} {{ HTML::link('tratamientos', 'Tratamientos') }}
    @endforeach
{{ Form::close() }}
@stop