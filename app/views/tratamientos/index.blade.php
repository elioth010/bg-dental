@extends('layouts.main')

@section('contenido')
	<div class="search">
  {{ HTML::linkAction('TratamientosController@show', 'Buscar tratamientos') }}</div>
  <h1>
  Tratamientos
  </h1>
  <table>
      <tr>
          <th>Código</th>
          <th>Nombre tratamiento</th>
          @foreach($tcp_cabecera as $tcp_cabecera)
              <th>{{$tcp_cabecera->nombre_comp}}</th>
          @endforeach
      </tr>
  </table>
<table>
      @foreach($tcp_contenido as $tcp_contenido)
          <tr title="{{$tcp_contenido->nombre_trat}}">

          <td>{{$tcp_contenido->codigo}}</td>
          <td>{{ HTML::linkAction('TratamientosController@edit', $tcp_contenido->nombre_trat, $tcp_contenido->id) }}</td>
          
              <?php $precios = explode(",", $tcp_contenido->precios);?>
                    @foreach($precios as $precio)
                        <td>{{$precio.'€'}}</td>
                    @endforeach
          </tr>
      @endforeach

  </table>

@stop
