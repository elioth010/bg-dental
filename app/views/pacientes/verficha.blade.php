@extends('layouts.main')
 
@section('contenido')
verficha.blade.php
    @foreach($paciente as $paciente)
{{ Form::open(array('url'=>'pacientes/$paciente->id/editarficha')) }}     
    <h1>Ficha del paciente:</h1>

<ul class="labelreg4">
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
    <li>{{ Form::select('compania', $companias, null) }}</li>
        <br>
    <li>{{--{{ Form::submit('Guardar cambios')}}--}}</li>
    <li>{{ Form::button('Atrás', array('class'=>'botonl'))}} {{ HTML::linkAction('PresupuestosController@verpresupuestos', 'Presupuestos de este paciente', $paciente->numerohistoria) }}</li>

</ul>
    @endforeach
{{ Form::close() }}
@stop
