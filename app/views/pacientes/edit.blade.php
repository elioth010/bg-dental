@extends('layouts.main')

@section('title')
    Editar paciente
@stop

@section('contenido')

{{ Form::open(array('url'=>'paciente/'.$paciente->id, 'method' => 'put')) }}
    <h1>Ficha del paciente:</h1>

<ul class="labelreg5">
	<li>NHC</li>
    <li>Nombre:</li>
    <li>Apellidos:</li>
    <li>NIF:</li>
    <li>Dirección:</li>
    <li>Ciudad:</li>
    <li>Código Postal:</li>
    <li>Teléfonos:</li>
    <li>Compañía:</li>

</ul>

<ul class="labelreg3">
	<li>{{ Form::text('numerohistoria', $paciente->numerohistoria) }}</li>
    <li>{{ Form::text('nombre', $paciente->nombre) }}</li>
    <li>{{ Form::text('apellido1', $paciente->apellido1) }}  {{ Form::text('apellido2', $paciente->apellido2) }}</li>
    <li>{{ Form::text('NIF', $paciente->NIF) }}</li>
    <li>{{ Form::text('addrnamestre', $paciente->addrnamestre) }} {{ Form::text('direccion', $paciente->direccion) }}</li>
    <li>{{ Form::text('terrdesc', $paciente->terrdesc) }}</li>
    <li>{{ Form::text('terrdesc', $paciente->addrpostcode) }}</li>
    <li>{{ Form::text('addrtel2', $paciente->addrtel2) }}  {{ Form::text('addrtel2', $paciente->addrtel2) }}</li>
    <li>{{ Form::select('compania', $companias, $paciente->compania) }}</li>
    <?php $companias[0]= "-- Ninguna --"; ?>
    <li>{{ Form::select('compania2', $companias, $paciente->compania2 ) }}</li>
        <br>
    <li>{{ Form::submit('Guardar cambios')}}</li>
    <li>{{--{{ Form::button('Atrás', array('class'=>'botonl'))}}--}} {{ HTML::linkAction('PresupuestosController@verpresupuestos', 'Presupuestos de este paciente', $paciente->numerohistoria) }}</li>
    <li>{{ HTML::linkAction('CobrosController@show', 'Cobros de este paciente', $paciente->id) }}</li>

</ul>
{{ Form::close() }}
@stop
