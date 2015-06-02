@extends('layouts.main')

@section('contenido')
<h2>Editar turnos de la sede: {{$sede->nombre}}</h2>

<p>En el calendario se muestran los turnos para los próximos 7 días de este mes. Los cambios que realice se verán también reflejados en las semanas siguientes.</p>

{{ Form::open(array('url'=>'turno/'.$sede->id, 'method' => 'put')) }}
{{ Form::hidden('sede_id', $sede->id) }}
{{ Form::hidden('today', $today) }}
{{ $calendario }}

{{ Form::submit('Guardar cambios', array('class'=>'botonl')) }}
{{ HTML::linkAction('TurnoController@show', 'Volver', $sede->id) }}
{{ Form::close() }}
@stop
