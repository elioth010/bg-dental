@extends('layouts.main')

@section('contenido')

  <div class="search">
  {{ HTML::linkAction('PacientesController@buscar', 'Buscar pacientes') }}
  </div>
  <div class="top">
  <h3>Pacientes en espera ({{ count($esperas) }}):</h3>

    @if (count($esperas) > 0)
    <div class="labelreg6">
        <table border = "1">
            <tr>
                <th>Hora de llegada</th>
                <th>NHC</th>
                <th>Nombre</th>
                <th>Presupuestos</th>
                <th>Profesional asignado</th>
                <th>Acciones</th>
            </tr>
        @foreach($esperas as $espera)
            <tr>
                <td>{{ $espera->begin_date }}</td>
                <td>{{ HTML::linkAction('PacientesController@edit', $espera->numerohistoria, $espera->paciente_id) }}</td>
                <td>{{ $espera->nombre }} {{ $espera->apellido1." ".$espera->apellido2 }}</td>
                <td>{{ HTML::linkAction('PresupuestosController@verpresupuestos', 'Presupuestos de este paciente', $espera->numerohistoria) }}</td>
                <td>{{ $espera->profesional_id }}</td>
            {{ var_dump($espera) }}
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
  <h3>Últimos pacientes creados ({{ count($pacientes) }}):</h3>

    @if (count($pacientes) > 0)
  	<div class="labelreg6">
    <table border = "1">
        <tr>
            <th>NHC</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Presupuestos</th>
            <th>Profesional a asignar</th>
            <th>Acción</th>
        </tr>
        @foreach($pacientes as $paciente)
        <tr>
            <td>{{ HTML::linkAction('PacientesController@edit',  $paciente->numerohistoria, $paciente->id) }}</td>
            <td>{{ $paciente->nombre }}</td>
            <td>{{ $paciente->apellido1." ".$paciente->apellido2 }}</td>
            <td>{{ HTML::linkAction('PresupuestosController@verpresupuestos', 'Presupuestos de este paciente', $paciente->numerohistoria) }}</td>
        {{ Form::open(array('url'=>'espera/', 'method' => 'post')) }}
        {{ Form::hidden('paciente_id', $paciente->id) }}
            <td>{{ Form::select('profesional_id', $profesionales) }}</td>
        @if ($paciente->admitido == 1)
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
