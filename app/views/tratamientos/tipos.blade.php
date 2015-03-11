@extends('tratamientos.creartipo')
 
@section('listado_tipos')
 <h3>
  Compañías:
  </h2>
  
    <table border = "1">
      <tr>
      <th>Id
      </th><th>Tipo de tratamiento
      </th>
      </tr>
      
      @foreach($tipos as $tipo)
        <tr>
        <td>{{$tipo->tipo}}</td>
        </tr>
      @endforeach
      
    </table>
@stop