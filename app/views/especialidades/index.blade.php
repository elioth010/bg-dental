@extends('especialidades.crearespecialidad')
 
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
        <td>{{$especialidad->codigo}}</td>
        <td>{{$especialidad->especialidad}}</td>
        </tr>
      @endforeach
      
    </table>
@stop