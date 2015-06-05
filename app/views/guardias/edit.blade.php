@extends('layouts.main')

@section('contenido')
<div class="overflow">
<h2>Editar Guardias {{ $sede->nombre }}</h2>
{{ Form::open(array('url'=>"guardia/$sede->id/$year/$month", 'method' => 'put')) }}
{{ Form::submit('Guardar guardia', array('class'=>'botonl')) }}
{{ $calendario }}
{{ Form::close() }}
</div>
@stop
