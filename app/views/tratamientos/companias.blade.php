@extends('tratamientos.crearcompania')
 
@section('listado_comps')
 <h3>
  Compañías:
  </h2>
  
    <table border = "1">
      <tr>
      <th>Nombre
      </th><th>Código
      </th><th>Comentarios
      </th>
      </tr>
      
      @foreach($companias as $companias)
        <tr>
        
        <td>{{ HTML::linkAction('CompaniasController@edit', $companias->nombre, $companias->id) }}</td>
        <td>{{$companias->codigo}}</td>
        <td>{{$companias->comentarios}}</td>
        </tr>
      @endforeach
      
    </table>
@stop