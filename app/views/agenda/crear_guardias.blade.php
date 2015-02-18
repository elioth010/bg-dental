@extends('layouts.main')
 
@section('contenido')
{{ Form::open(array('url'=>'guardia')) }}     
{{ $calendario }}
{{Form::hidden('numero_dias',$numero_dias)}}
<li>{{ Form::submit('Guardar guardia', array('class'=>'botonl'))}}</li>
{{Form::close()}}
@stop