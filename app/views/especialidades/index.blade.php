@extends('especialidades.crearespecialidad')

@section('title')
    Especialidades
@stop

@section('listado_especs')
 <h3>
  Especialidades:
  </h3>

    <table border = "1">
      <tr>
      <th>Código
      </th><th>Nombre
      </th>
      </tr>

      @foreach($especialidades as $especialidad)
        <tr>
        <td>{{ HTML::linkAction('EspecialidadController@edit',  $especialidad->codigo, $especialidad->id) }}</td>
        <td>{{$especialidad->especialidad}}</td>
        </tr>
      @endforeach

    </table>
@stop
