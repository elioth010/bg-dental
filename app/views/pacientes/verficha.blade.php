@extends('layouts.main')
 
@section('contenido')
verficha.blade.php
    @foreach($paciente as $paciente)
{{ Form::open(array('url'=>'pacientes/$paciente->id/editarficha')) }}     
    <h1>Ficha del paciente:</h1>

<ul>

 	<li>NHC:{{ Form::text('numerohistoria', $paciente->numerohistoria) }}
    Nombre:
    {{ Form::text('nombre', $paciente->nombre) }}
    Apellidos:    {{ Form::text('apellido1', $paciente->apellido1) }}  {{ Form::text('apellido2', $paciente->apellido2) }}</li>
    <li>NIF:  {{ Form::text('NIF', $paciente->NIF) }}
    <li>Dirección:{{ Form::text('addrnamestre', $paciente->addrnamestre) }}</li>
    <li>{{ Form::text('direccion', $paciente->direccion) }}</li>
    <li>Ciudad:{{ Form::text('terrdesc', $paciente->terrdesc) }}</li>
    <li>Código Postal:{{ Form::text('terrdesc', $paciente->addrpostcode) }}</li>
    <li>Teléfonos: {{ Form::text('addrtel2', $paciente->addrtel2) }}  {{ Form::text('addrtel2', $paciente->addrtel2) }}</li>
    <li>Compañía: {{ Form::select('compania', $companias, null) }}</li>
    <br>
    <li>{{--{{ Form::submit('Guardar cambios')}}--}}</li>
    <li>{{ Form::button('Atrás')}} {{ HTML::link('pacientes/'.$paciente->numerohistoria.'/presupuestos', 'Presupuestos de este paciente') }}</li>

</ul>
    @endforeach
{{ Form::close() }}
@stop