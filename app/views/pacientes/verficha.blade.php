@extends('layouts.main')
 
@section('contenido')
verficha.blade.php
    @foreach($paciente as $paciente)
{{ Form::open(array('url'=>'pacientes/$paciente->id/editarficha')) }}     
    <h1>Ficha del paciente:</h1>
    NHC:
    {{ Form::text('numerohistoria', $paciente->numerohistoria) }}
    Nombre:
    {{ Form::text('nombre', $paciente->nombre) }}
    Apellidos:
    {{ Form::text('apellido1', $paciente->apellido1) }}
    {{ Form::text('apellido2', $paciente->apellido2) }}
    <p>NIF:
    {{ Form::text('NIF', $paciente->NIF) }}
    <p>Dirección:<p>
    {{ Form::text('addrnamestre', $paciente->addrnamestre) }}<p>
    {{ Form::text('direccion', $paciente->direccion) }}<p>
    {{ Form::text('terrdesc', $paciente->terrdesc) }}<p>
    {{ Form::text('terrdesc', $paciente->addrpostcode) }}<p>
    Teléfonos:    
    
    {{ Form::text('addrtel2', $paciente->addrtel2) }}<p>
    {{ Form::text('addrtel2', $paciente->addrtel2) }}<p>
    Compañía: {{ Form::select('compania', $companias, null) }}
    <br>
    {{--{{ Form::submit('Guardar cambios')}}--}}
    {{ Form::button('Atrás')}} {{ HTML::link('pacientes/'.$paciente->numerohistoria.'/presupuestos', 'Presupuestos de este paciente') }}

    @endforeach
{{ Form::close() }}
@stop