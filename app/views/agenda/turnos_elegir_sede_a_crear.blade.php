@extends('layouts.main')

@section('contenido')
<div class="search">
	

    {{ Form::open(array('url'=>'turno/create_tps')) }}
    <h1 style="margin-top:40px;">Eliga una sede:</h1>
    <div class="labelreg6">
    {{Form::select('sede', $sedes)}}
    <li style="margin-top:8px;">{{ Form::submit('Seleccionar', array('class'=>'botonl'))}}</li>
    {{ Form::close() }}
    </div>
</div>
@stop

