@extends('opciones.crearopciones')
 
@section('listado_opciones')
 <h3>
  Opciones:
  </h3>

    <table border = "1">
      <tr>
      <th>Nombre</th>
      <th>Valor</th>
      </tr>
      
      @foreach($opciones as $opcion)
        <tr>
        <td>{{$opcion->nombre}}</td>
        <td>{{$opcion->valor}}</td>
        </tr>
      @endforeach
      
    </table>
@stop