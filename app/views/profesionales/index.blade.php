@extends('profesionales.crearprofesional')
 
@section('listado_profs')
 <h3>
  Profesionales:
  </h3>
  
    <table border = "1">
      <tr>
      <th>Nombre
      </th><th>Apellidos
      </th><th>Especialidad
      </th><th>Sede(s)
      </th>
      </tr>
      
      @foreach($profesionales as $profesional)
        <tr>
        
        <td>{{$profesional->nombre}}</td>
        <td>{{$profesional->apellido1}}, {{$profesional->apellido2}}</td>
        <td>{{$profesional->especialidad}}</td>
        <td>{{$profesional->sedes_p}}</td>
        </tr>
      @endforeach
      
    </table>
@stop