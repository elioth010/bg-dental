@extends('layouts.main')
@include('includes.buscar_p')

@section('contenido')
@yield('buscar_p')
<div class="overflow">
<h1>Paciente:</h1>

 @if (count($pacientes) > 0)
  	<div>
    <table border = "1" style="margin:auto">
        <tr>
            <th>NHC</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Presupuestos</th>
            <th>Acceso a hitorial clínico</th>
            <th>Saldo</th>
            <th>Profesional asignado</th>
            <th>Acción</th>
        </tr>
        @foreach($pacientes as $paciente)
        <tr>
            <td>{{ HTML::linkAction('PacientesController@edit',  $paciente->numerohistoria, $paciente->id) }}</td>
            <td>{{ $paciente->nombre }}</td>
            <td>{{ $paciente->apellido1." ".$paciente->apellido2 }}</td>
            <td>{{ HTML::linkAction('PresupuestosController@verpresupuestos', 'Presupuestos de este paciente', $paciente->numerohistoria) }}</td>
            <td>{{ HTML::linkAction('Historial_clinicoController@show', 'Historial clínico', $paciente->id) }}</td>
            <td>{{$paciente->saldo, 0}} €</td>
        @if (isset($paciente->admitido) && ($paciente->admitido == 1))
        <td>{{$paciente->prof_asignado}}</td>
        @else
        {{ Form::open(array('url'=>'espera/', 'method' => 'post')) }}
        {{ Form::hidden('paciente_id', $paciente->id) }}
            <td>{{ Form::select('profesional_id', $profesionales) }}</td>
        @endif
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
{{--
<table border = "1">
    <tr>
        <th>NHC</th>
        <th>Nombre</th>
        <th>Apellidos</th>
        <th>Admitidos</th>
    </tr>

    @foreach($pacientes as $paciente)
    <tr>
        <td>{{ HTML::linkAction('PacientesController@edit',  $paciente->numerohistoria, $paciente->id) }}</td>
        <td> {{ $paciente->nombre }}</td>
        <td> {{ $paciente->apellido1." ".$paciente->apellido2 }}</td>
         {{ Form::open(array('url'=>'espera/'.$paciente->id, 'method' => 'put')) }}
         <td>
                {{Form::select('profesional_id', $profesionales)}}
                
            </td>
           @if (isset($paciente->admitido) && ($paciente->admitido == 1))
        <td>{{$paciente->p_n}}, {{$paciente->p_a1}} {{$paciente->p_a2}}</td>
        @else
        {{ Form::open(array('url'=>'espera/', 'method' => 'post')) }}
        {{ Form::hidden('paciente_id', $paciente->id) }}
            <td>{{ Form::select('profesional_id', $profesionales) }}</td>
        @endif
        @if (isset($paciente->admitido) && ($paciente->admitido == 1))
            <td>En espera</td>
        @else
            <td>{{ Form::submit('Admitir') }}</td>
        @endif
        {{Form::close()}}
    </tr>
    @endforeach

</table> --}}
</div>
@stop
