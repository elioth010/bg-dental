@extends('layouts.main')

@section('contenido')

  <div class="search">
  {{ HTML::linkAction('PacientesController@buscar', 'Buscar pacientes') }}
  </div>
  <div class="top">

  <h3>Últimos pacientes creados ({{ count($pacientes) }}):</h3>

    @if (count($pacientes) > 0)
  	<div class="labelreg6">
    <table border = "1">
        <tr>
            <th>NHC</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Presupuestos</th>
            <th>Saldo</th>
            <th>Profesional a asignar</th>
            <th>Acción</th>
        </tr>
        @foreach($pacientes as $paciente)
        <tr>
            <td>{{ HTML::linkAction('PacientesController@edit',  $paciente->numerohistoria, $paciente->id) }}</td>
            <td>{{ $paciente->nombre }}</td>
            <td>{{ $paciente->apellido1." ".$paciente->apellido2 }}</td>
            <td>{{ HTML::linkAction('PresupuestosController@verpresupuestos', 'Presupuestos de este paciente', $paciente->numerohistoria) }}</td>
            <td>{{$paciente->saldo}} €</td>
        {{ Form::open(array('url'=>'espera/', 'method' => 'post')) }}
        {{ Form::hidden('paciente_id', $paciente->id) }}
            <td>{{ Form::select('profesional_id', $profesionales) }}</td>
        @if (isset($esperas[$paciente->id]) && ($esperas[$paciente->id] == 1))
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
        No hay pacientes creados en los últimos días.
    @endif
</div>
@stop
