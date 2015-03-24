@extends('layouts.main')

@section('contenido')
<div class="search">
	{{ HTML::linkAction('TratamientosController@show', 'Buscar tratamientos') }}</div>

    {{ Form::open(array('url'=>'tratamientos/index_tpg')) }}
    <h1 style="margin-top:40px;">Eliga un grupo de tratamientos:</h1>
    <div class="labelreg6">
    {{Form::select('grupos', $grupos)}}
    <li style="margin-top:8px;">{{ Form::submit('Seleccionar', array('class'=>'botonl'))}}</li>
    {{ Form::close() }}
    </div>
@stop