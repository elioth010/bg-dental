@extends('layouts.main')

@section('title')
    Elegir profesional a asignar:
@stop

@section('contenido')
<div class="search">
	</div>

    {{ Form::open(array('url'=>'historial_clinico/asignar_prof')) }}
    <h1 style="margin-top:40px;">Elija un profesional:</h1>
    <div class="labelreg6">
    {{Form::select('profesional_id', $profesionales)}}
    {{Form::hidden('historial_id', $historial_id)}}
    <li style="margin-top:8px;">{{ Form::submit('Seleccionar', array('class'=>'botonl'))}}</li>
    {{ Form::close() }}
    </div>
@stop
