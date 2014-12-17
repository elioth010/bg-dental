@extends('layouts.main')
 
@section('contenido')

  {{ HTML::link('/tratamientos/buscar', 'Buscar tratamientos')}}<p>
  <h1>
  Tratamientos
  </h1>
   
   
   <?php $un_trat = "nombre raro";?>
   @foreach($tcp as $tcp)
   
      @if($un_trat === 'nombre raro' or $un_trat != $tcp->nombre_trat)
	  <p><h2>{{$tcp->nombre_trat}}</h2><br>
	  <?php $un_trat = $tcp->nombre_trat ?>
      @else
      <table>
      	    <tr>
		<td>{{$tcp->nombre_comp}}</td>
		<td>{{$tcp->precio}}</td>
		<td>{{ HTML::link('/tratamientos/'.$tcp->id.'/editar', 'editar')}}</td>
	    </tr>
      </table>
      @endif
      
      
   @endforeach
   

   
   
   

      
@stop 


