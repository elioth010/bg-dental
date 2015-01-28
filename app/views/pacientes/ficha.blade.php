@extends('layouts.main')
 
@section('contenido')
        <h1>
  Paciente:
  </h1>
 
    <table border = "1">
      <tr>
      <th>NHC
      </th><th>Nombre
      </th><th>Apellidos
      </th>
      </tr>
     
        @foreach($paciente as $paciente)
        <tr>        
        <td>{{ HTML::link('pacientes/'.$paciente->numerohistoria, $paciente->numerohistoria); }}
        </td>
        <td>{{$paciente->nombre}}</td>
        <td>{{$paciente->apellido1." ".$paciente->apellido2}}</td>
        
        </tr>
        @endforeach
     
    </table>
@stop
