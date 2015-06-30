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
         <td>{{$item->euros}} €</td>    
     </tr>
 @endforeach
     <tr>
         <td><b>Total a percibir:</b></td>
         <td><b>{{$suma}} €</b></td>
     </tr>
 </table>
 </div>
@stop