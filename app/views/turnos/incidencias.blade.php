@extends('layouts.main')

@section('title')
    Incidencias de turnos
@stop

@section('contenido')
 <h3>
  Incidencias:
  </h3>

    <table border = "1">
      <tr>
      <th>Fecha del turno</th>
      <th>Profesional</th>
      <th>Sede</th>
      <th>Incidencia</th>
      </tr>

      @foreach($incidencias as $item)
        <tr>
        <td>{{$item->fecha}}</td>
        <td>{{$item->p_n}}, {{$item->p_a1}} {{$item->p_a2}}</td>
        <td>{{$item->s_n}}</td>
        <td>{{$item->incidencia_text}}</td>
        </tr>
      @endforeach

    </table>
@stop
