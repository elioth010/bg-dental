@extends('layouts.main')
 
@section('contenido')
	<div class="labelreg3">
 <h3>Tratamientos pendientes de cobro:</h3>
 Elegir intervalo de tiempo:
 {{ Form::open(array('url'=>'estadisticas')) }}
 {{ Form::text('fecha_inicio', '', array( 'class' => 'datepicker euros')) }} - {{ Form::text('fecha_fin', '', array( 'class' => 'datepicker euros')) }}
 {{ Form::submit('OK', array('class'=>'botonl'))}}
 {{ Form::close() }}
 </div>
 

 <div class="overflow">
 
 <h3>Pemdientes de cobro mes actual:</h3></br>
 
 <table>
     <tr>
         <th>Fecha realización</th>
         <th>Tratamiento</th>
         <th>precio</th>
     </tr>
 @foreach($p_d_c as $item)
 <tr>
     <td>{{$item->fecha_realizacion}}</td>
     <td>{{$item->id}}</td>
     <td>{{$item->precio}}
    @endforeach
 </table>   


 </div>  
@stop