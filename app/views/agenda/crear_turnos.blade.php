@extends('layouts.main')
 
@section('contenido')
{{ Form::open(array('url'=>'turno')) }}     
{{ $calendario }}
{{Form::hidden('numero_dias',$numero_dias)}}
<li>{{ Form::submit('Guardar turnos', array('class'=>'botonl'))}}</li>
{{Form::close()}}
@stop