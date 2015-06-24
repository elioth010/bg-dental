@extends('layouts.main')

@section('title')
    Editar paciente
@stop

@section('contenido')


    <h1>Ficha del paciente:</h1>

<ul class="labelreg5">
    <li>NHC:</li>
    <li>Nombre:</li>
    <li>Apellidos:</li>
    <li>NIF:</li>
    <li>Dirección:</li>
    <li>Ciudad:</li>
    <li>Código Postal:</li>
    <li>Teléfonos:</li>
    <li>Compañía principal:</li>
    <li>Compañía opcional:</li>

</ul>

<ul class="labelreg5">
    <li> -{{$paciente->numerohistoria}}</li>
    <li> -{{$paciente->nombre}}</li>
    <li> -{{$paciente->apellido1 }} {{ $paciente->apellido2 }}</li>
    <li> -{{$paciente->NIF }}</li>
    <li> -{{$paciente->addrnamestre}} {{$paciente->direccion}}</li>
    <li> -{{$paciente->terrdesc}}</li>
    <li> -{{$paciente->addrpostcode}}</li>
    <li> -{{$paciente->addrtel2}}  {{$paciente->addrtel2}}</li>
    <li> -{{$paciente->c1}}</li>
    <li> -{{$paciente->c2}}</li>

</ul>
   <br>
    {{--{{ Form::button('Atrás', array('class'=>'botonl'))}}--}}
    {{ HTML::linkAction('PresupuestosController@verpresupuestos', 'Presupuestos de este paciente', $paciente->numerohistoria, array('class' => 'btn')) }}

    {{ HTML::linkAction('CobrosController@show', 'Cobros de este paciente', $paciente->id, array('class' => 'btn')) }}


@stop
