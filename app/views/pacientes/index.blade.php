@extends('layouts.main')

@section('contenido')

  <div class="search">
  {{ HTML::linkAction('PacientesController@show', 'Buscar pacientes') }}
  </div>
  <div class="top">
  <h3>
  Últimos pacientes creados:
  </h2>
    <table border = "1">
      <tr>
      <th>NHC
      </th><th>Nombre
      </th><th>Apellidos
      </th>
      </tr>
      @foreach($pacientes as $paciente)
        <tr>
        <td>{{ HTML::linkAction('PacientesController@verficha', $paciente->numerohistoria, $paciente->numerohistoria) }}</td>
        <td>{{$paciente->nombre}}</td>
        <td>{{$paciente->apellido1." ".$paciente->apellido2}}</td>
        </tr>
      @endforeach
    </table>
</div>
@stop
