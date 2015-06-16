@extends('layouts.main')




@section('contenido')

 <div class="overflow">
 
 <h3>Guardias de {{$profesional->nombre}} realizadas en {{$sede->nombre}} entre el {{$fecha_inicio}} y el {{$fecha_fin}}:</h3></br>
 <table>
     <tr>
         <th>Fecha realización</th>
         <th>Recaudación</th>
         
     </tr>
 @foreach($guardias as $item)
     <tr>
         <td>{{$item->fecha}}</td>
         <td>euros según tabla opciones</td>
     </tr>
 @endforeach
     <tr>
         <td>Total a percibir:</td>
         <td>Suma de los turnos según parámetros</td>
     </tr>
 </table>
 </div>
@stop