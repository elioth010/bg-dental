@extends('layouts.main')

@section('title')
    Estadísticas: morosos
@stop

@section('contenido')
	<div class="labelreg3">
 <h3>Tratamientos pendientes de cobro:</h3>
Elegir intervalo de tiempo:
 {{ Form::open(array('url'=>'cobros/pdc_cf')) }}
 {{ Form::text('fecha_inicio', '', array( 'class' => 'datepicker euros')) }} - {{ Form::text('fecha_fin', '', array( 'class' => 'datepicker euros')) }}
 {{ Form::submit('OK', array('class'=>'botonl'))}}
 {{ Form::close() }}
 </div>


 <div class="overflow">

 <h3>Pedientes de cobro mes actual:</h3></br>

 <table>
     <tr>
         <th>Fecha realización</th>
         <th>Nombre paciente</th>
         <th>Historial clínico</th>
         <th>precio</th>
     </tr>
 @foreach($p_d_c as $item)
 <tr>
     <td>{{$item->fecha_realizacion}}</td>
     <td>{{$item->p_n}}, {{$item->p_a1}} {{$item->p_a2}}</td>
     <td>{{ HTML::linkAction('Historial_clinicoController@show', 'Historial clínico', $item->paciente_id) }}</td>
     <td>{{$item->precio}}
    @endforeach
 </table>


 </div>
@stop
