@extends('layouts.main')
 
@section('contenido')
<h2>Crear Guardias {{$sede->nombre}}</h2>
{{ Form::open(array('url'=>'guardia')) }}
{{Form::hidden('sede_id', $sede->id)}}
{{ $calendario }}
{{Form::hidden('numero_dias',$numero_dias)}}
<li>{{ Form::submit('Guardar guardia', array('class'=>'botonl'))}}</li>
{{Form::close()}}
@stop