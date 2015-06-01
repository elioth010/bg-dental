@extends('layouts.main')

@section('metas')
<meta http-equiv="refresh" content="30">
@stop

@section('contenido')
{{ Form::open(array('url'=>'historial_clinico/busqueda')) }}
    <h1>Busque un paciente para acceder a su historial clínico:</h1>

    {{ Form::text('nombre', null, array('placeholder'=>'Texto a buscar o NHC')) }}

   <!-- {{ Form::text('apellido2', null, array('placeholder'=>'Segundo apellido')) }}-->
    {{ Form::submit('Buscar', array('class'=>'botonl'))}}
{{ Form::close() }}

<div class="top">
<h3>Pacientes para el Profesional {{$profesional->nombre}}, {{$profesional->apellido1}} {{$profesional->apellido2}} en espera ({{ count($esperas) }}):</h3>

  @if (count($esperas) > 0)
  <div class="labelreg6">
      <table border = "1">
          <tr>
              <th>Hora de llegada</th>
              <th>NHC</th>
              <th>Historial clínico</th>
              <th>Nombre</th>
              <th>Saldo</th>
              <th>Profesional asignado</th>
              <th>Acciones</th>
          </tr>
      @foreach($esperas as $espera)
          <tr>
              <td>{{ $espera->begin_date }}</td>
              <td>{{ HTML::linkAction('PacientesController@edit', $espera->numerohistoria, $espera->paciente_id) }}</td>
              <td>{{ HTML::linkAction('Historial_clinicoController@show', 'Acceder al historial clínico', $espera->paciente_id) }}</td>
              <td>{{ $espera->nombre }} {{ $espera->apellido1." ".$espera->apellido2 }}</td>
              <td>{{$espera->saldo, '0,00'}} €</td>
              <td>{{ $profesionales[$espera->profesional_id] }}</td>
          {{ Form::open(array('url'=>'espera/'.$espera->id, 'method' => 'put')) }}
              <td>{{ Form::submit('Finalizar') }}</td>
          {{Form::close()}}
          </tr>
      @endforeach
      </table>
  </div>
  @else
      No hay pacientes en espera.
  @endif
</div>
@stop
