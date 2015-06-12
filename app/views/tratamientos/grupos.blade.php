@extends('tratamientos.creargrupo')

@section('title')
    Grupos de tratamientos
@stop

@section('listado_grps')
 <h3>
  Grupos:
  </h2>
    <table border = "1">
      <tr>
      <th>Id
      </th><th>Nombre
      </th><th>Código
      </th>
      </tr>
      @foreach($grupos as $grupo)
        <tr>
        <td>{{$grupo->id}}</td>
        <td>{{$grupo->nombre}}</td>
        <td>{{$grupo->codigo}}</td>
        </tr>
      @endforeach
    </table>
@stop
