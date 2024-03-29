@extends('layouts.main')

@section('title')
    Pacientes
@stop

@section('contenido')

  <div class="search">
  {{ HTML::linkAction('PacientesController@buscar', 'Buscar pacientes') }}
  </div>
  <div class="top">

  <h3>Pacientes en sala de espera ({{ count($pacientes) }}):</h3>

    @if (count($pacientes) > 0)
  	<div>
    <table border = "1" style="margin:auto">
        <tr>
            <th>NHC</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Presupuestos</th>
            <th>Acceso a historial clínico</th>
            {{-- <th>Saldo</th> --}}
            <th>Profesional asignado</th>
            <th>Sede</th>
            <th>Acción</th>
        </tr>
        @foreach($pacientes as $paciente)
        <tr>
            <td>{{ HTML::linkAction('PacientesController@edit',  $paciente->numerohistoria, $paciente->paciente_id) }}</td>
            <td>{{ $paciente->nombre }}</td>
            <td>{{ $paciente->apellido1." ".$paciente->apellido2 }}</td>
            <td>{{ HTML::linkAction('PresupuestosController@verpresupuestos', 'Presupuestos de este paciente', $paciente->numerohistoria) }}</td>
            <td>{{ HTML::linkAction('Historial_clinicoController@show', 'Historial clínico', $paciente->paciente_id) }}</td>
            {{--<td>{{$paciente->p_d_c}} €</td>--}}
            
        @if (isset($paciente->admitido) && ($paciente->admitido == 1))
        <td>{{$paciente->p_n}}, {{$paciente->p_a1}} {{$paciente->p_a2}}</td>
        @else
        {{ Form::open(array('url'=>'espera/', 'method' => 'post')) }}
        {{ Form::hidden('paciente_id', $paciente->id) }}
            <td>{{ Form::select('profesional_id', $profesionales) }}</td>
        @endif
        <td>{{$paciente->sede_n}}</td>
        @if (isset($paciente->admitido) && ($paciente->admitido == 1))
            <td>En espera</td>
        @else
            <td>{{ Form::submit('Admitir') }}</td>
        @endif
        {{Form::close()}}
        </tr>
        @endforeach
    </table>
	</div>
    @else
        No hay pacientes en la sala de espera o en las consultas.
    @endif
</div>
@stop
