@extends('layouts.main')

@section('title')
    Cobros
@stop

@section('contenido')
 <div style="margin-top:10px; float:left; width: 300px;">
 <h3>Cobros:</h3>
  Elegir intervalo de tiempo:
 {{ Form::open(array('url'=>'cobros/cf')) }}
 {{ Form::text('fecha_inicio', '', array( 'class' => 'datepicker euros')) }} - {{ Form::text('fecha_fin', '', array( 'class' => 'datepicker euros')) }}
 {{ Form::submit('OK', array('class'=>'botonl'))}}
 {{ Form::close() }}
 </div>
	
	<div style="max-width:550px; margin-top:30px; max-height: 480px; overflow:auto;">
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
        <td>{{$cobro->p_n}}, {{$cobro->p_a1}} {{$cobro->p_a2}}</td>
        <td>{{ HTML::linkAction('Historial_clinicoController@show', 'Historial clínico', $cobro->paciente_id) }}</td>
        <td>{{$cobro->cobro}}</td>
        <td>{{$cobro->tc_n}}</td>
        <td>{{$cobro->creado}}</td>
        </tr>
      @endforeach

    </table>
  </div>
@stop
