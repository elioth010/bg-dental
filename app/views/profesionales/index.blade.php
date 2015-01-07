@extends('profesionales.crearprofesional')
 
@section('listado_profs')
 <h3>
  Compañías:
  </h2>
  
    <table border = "1">
      <tr>
      <th>Id
      </th><th>Nombre
      </th><th>Apellidos
      </th><th>Especialidad
      </th>
      </tr>
      
      @foreach($profesionales as $profesional)
        <tr>
        <td>{{$profesional->id}}</td>
        <td>{{$profesional->nombre}}</td>
        <td>{{$profesional->apellido1}}, {{$profesional->apellido2}}</td>
        <td>{{$profesional->especialidad}}</td>
        </tr>
      @endforeach
      
    </table>
@stop