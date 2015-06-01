@extends('layouts.main')
 
@section('contenido')
 <h3>
  Cobros:
  </h3>

    <table border = "1">
      <tr>
      <th>Paciente</th>
      <th>Cantidad</th>
      <th>Tipo de cobro</th>
      <th>Fecha de cobro</th>
      </tr>
      
      @foreach($cobros as $cobro)
        <tr>
        <td>{{$cobro->p_n}}</td>
        <td>{{$cobro->cobro}}</td>
        <td>{{$cobro->tc_n}}</td>
        <td>{{$cobro->created_at}}</td>
        </tr>
      @endforeach
      
    </table>
@stop