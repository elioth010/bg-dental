@extends('layouts.main')

@section('contenido')

 
  <div class="top">
  <h3>Este mes:</h3>
  	<div class="labelreg6">
    <table border = "1">
        <tr>
            <th>Tratamiento</th>
            <th>Fecha de realización</th>
            <th>Abonado por Quirón</th>
            <th>Cobrado por profesional</th>
        </tr>
        @foreach($pacientes as $paciente)
        <tr>
            <td>{{ HTML::linkAction('PacientesController@edit',  $paciente->numerohistoria, $paciente->id) }}</td>
            <td>{{ $paciente->nombre }}</td>
            <td>{{ $paciente->apellido1." ".$paciente->apellido2 }}</td>
        </tr>
        @endforeach
    </table>
	</div>
</div>
@stop
