@extends('layouts.main')

@section('title')
    Cobros
@stop

@section('contenido')
 <h3>
  Cobros:
  </h3>
	<div class="roll" style="margin-left:100px">
    <table border = "1">
      <tr>
      <th>Paciente</th>
      <th>ID de historial</th>
      <th>Cantidad</th>
      <th>Tipo de cobro</th>
      <th>Fecha de cobro</th>
      </tr>

      @foreach($cobros as $cobro)
        <tr>
        <td>{{$cobro->p_n}}</td>
        <td>{{ HTML::linkAction('Historial_clinicoController@show', 'Historial clínico', $cobro->paciente_id) }}</td>
        <td>{{$cobro->cobro}}</td>
        <td>{{$cobro->tc_n}}</td>
        <td>{{$cobro->created_at}}</td>
        </tr>
      @endforeach

    </table>
  </div>
@stop
