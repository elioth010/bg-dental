@extends('layouts.main')
 
@section('contenido')
<div class="overflow">
<h2>Crear Turnos {{$sede->nombre}}</h2>
{{ Form::open(array('url'=>'turno')) }}
{{Form::hidden('sede_id', $sede->id)}}
{{ $calendario }}
{{Form::hidden('numero_dias',$numero_dias)}}
<li>{{ Form::submit('Guardar turnos', array('class'=>'botonl'))}}</li>
{{Form::close()}}
</div>
@stop