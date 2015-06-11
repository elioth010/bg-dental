@extends('layouts.main')

@section('title')
    Crear guardia
@stop

@section('contenido')
<div class="overflow">
<h2>Crear Guardias {{ $sede->nombre }}</h2>
<p>Aún no se ha definido la guardia para este mes. Hágalo a continuación:</p>

{{ Form::open(array('url'=>"guardia/$sede->id/$year/$month")) }}
{{ Form::submit('Guardar guardia', array('class'=>'botonl')) }}
{{ $calendario }}
{{ Form::close() }}
</div>
@stop
