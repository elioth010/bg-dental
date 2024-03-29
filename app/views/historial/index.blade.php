@extends('layouts.main')

@section('title')
    Historial clínico
@stop

@section('metas')
<meta http-equiv="refresh" content="30">
@stop

@section('contenido')
<h1>Busque un paciente para acceder a su historial clínico:</h1>
{{ Form::open(array('url'=>'historial_clinico/busqueda', 'method' => 'get')) }}
    {{ Form::text('q', null, array('placeholder'=>'Texto a buscar o NHC', 'autofocus' => '')) }}
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
              {{--<th>Saldo</th>--}}
              <th>Profesional asignado</th>
              <th>Acciones</th>
          </tr>
      @foreach($esperas as $espera)
          <tr>
              <td>{{ $espera->begin }}</td>
              <td>{{ HTML::linkAction('PacientesController@show', $espera->numerohistoria, $espera->paciente_id) }}</td>
              <td>{{ HTML::linkAction('Historial_clinicoController@show', 'Acceder al historial clínico', $espera->paciente_id ) }}</td>
              <td>{{ $espera->nombre }} {{ $espera->apellido1." ".$espera->apellido2 }}</td>
              {{--<td>{{$espera->saldo, '0,00'}} €</td>--}}
              <td>{{ $profesionales[$espera->profesional_id] }}</td>
          {{ Form::open(array('url'=>'espera/'.$espera->id, 'method' => 'put')) }}
              <td> @if(Auth::user()->isAdmin() or Auth::user()->isRecepcion())
                  {{ Form::submit('Finalizar') }}
                  @endif
              </td>
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
