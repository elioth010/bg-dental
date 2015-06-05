@extends('layouts.main')

@section('contenido')
<div class="overflow">
<h2>Crear Guardias {{ $sede->nombre }}</h2>
{{ Form::open(array('url'=>"guardia/$sede->id/$year/$month")) }}
{{ Form::submit('Guardar guardia', array('class'=>'botonl')) }}
{{ $calendario }}
{{ Form::close() }}
</div>
@stop
