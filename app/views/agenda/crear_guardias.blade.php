@extends('layouts.main')
 
@section('contenido')
{{ Form::open(array('url'=>'guardia')) }}     
{{ $calendario }}
<li>{{ Form::submit('Guardar guardia', array('class'=>'botonl'))}}</li>
{{Form::close()}}
@stop