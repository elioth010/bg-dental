@extends('layouts.main')

@section('title')
    Estadísticas
@stop

@section('contenido')
	<div class="labelreg3">
 <h3>Estadísticas:</h3>
 Elegir intervalo de tiempo:
 {{ Form::open(array('url'=>'estadisticas')) }}
 {{ Form::text('fecha_inicio', '', array( 'class' => 'datepicker euros')) }} - {{ Form::text('fecha_fin', '', array( 'class' => 'datepicker euros')) }}
 {{ Form::submit('OK', array('class'=>'botonl'))}}
 {{ Form::close() }}
 </div>
 {{ HTML::linkAction('CobrosController@morosos', 'Pacientes con cobros pendientes') }}

 <div class="overflow">
 @foreach($profesionales as $profesional)
 <h3>Estadísticas de facturación mes actual:</h3></br>
 {{$profesional->apellido1}}
 <table>
     <tr>
         <th>Fecha realización</th>
         <th>Tratamiento</th>
         <th>precio</th>
     </tr>
 @foreach($facturacion as $item)
 <tr>
     <td>{{$item->fecha_realizacion}}</td>
     <td>{{$item->t_n}}</td>
     <td>{{$item->precio}}
    @endforeach
 </table>
 @endforeach

 </div>
@stop
