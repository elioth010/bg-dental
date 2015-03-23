@extends('layouts.main')

@section('contenido')
<div class="search">
	{{ HTML::linkAction('TratamientosController@show', 'Buscar tratamientos') }}</div>

    {{ Form::open(array('url'=>'tratamientos/index_tpg')) }}
    <br><br><h1>Eliga un grupo de tratamientos:</h1>
    {{Form::select('grupos', $grupos)}}
    <li>{{ Form::submit('Seleccionar', array('class'=>'botonl'))}}</li>
    {{ Form::close() }}
@stop