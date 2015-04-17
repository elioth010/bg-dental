@extends('sedes.crearsede')
 
@section('listado_sedes')
 <h3>
  Sedes:
  </h2>
  
    <table border = "1">
      <tr>
      <th>Nombre
      </th><th>Dirección
      </th><th>C.P.
      </th><th>Ciudad
      </th><th>Provincia
      </th><th>Tel.
      </th><th>Mail
      </th>
      </tr>
      
      @foreach($sedes as $sede)
        <tr>
        <td>{{ HTML::linkAction('SedesController@edit', $sede->nombre,$sede->id) }}</td>
        <td>{{$sede->calleynum}}</td>
        <td>{{$sede->cp}}</td>
        <td>{{$sede->ciudad}}</td>
        <td>{{$sede->provincia}}</td>
        <td>{{$sede->tel}}</td>
        <td>{{$sede->mail}}</td>
        </tr>
      @endforeach
      
    </table>
@stop