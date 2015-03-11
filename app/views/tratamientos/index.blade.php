@extends('layouts.main')

@section('contenido')
<<<<<<< HEAD
	<div class="search">
  {{ HTML::linkAction('TratamientosController@show', 'Buscar tratamientos') }}</div>
  <h1>
  Tratamientos
  </h1>
  <table class="scroll">
  <thead>
      <tr>
          <th>Código</th>
          <th>Nombre tratamiento</th>
          @foreach($tcp_cabecera as $tcp_cabecera)
          <th>{{$tcp_cabecera->nombre_comp}}</th>
          @endforeach
      </tr>
  </thead>
  <tbody>	
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
  </tbody>
  </table>

<script type="text/javascript">
var $table = $('table.scroll'),
    $bodyCells = $table.find('tbody tr:first').children(),
    colWidth;

// Adjust the width of thead cells when window resizes
$(window).resize(function() {
    // Get the tbody columns width array
    colWidth = $bodyCells.map(function() {
        return $(this).width();
    }).get();
    
    // Set the width of thead columns
    $table.find('thead tr').children().each(function(i, v) {
        $(v).width(colWidth[i]);
    });    
}).resize();
</script>

=======
<div class="search">
	{{ HTML::linkAction('TratamientosController@show', 'Buscar tratamientos') }}</div>
	<h1>Tratamientos</h1>
	<table>
		<tr>
			<th>Código</th>
			<th>Nombre tratamiento</th>
			@foreach($companias as $compania)
			<th>{{$compania}}</th>
			@endforeach
		</tr>
	</table>
	<table>
		@foreach($tratamientos as $tratamiento)
		<tr title="{{$tratamiento->nombre}}">

			<td>{{$tratamiento->codigo}}</td>
			<td>{{ HTML::linkAction('TratamientosController@edit', $tratamiento->nombre, $tratamiento->id) }}</td>

			<?php $precios = explode(",", $tratamiento->precios);?>
			@foreach($precios as $precio)
			<td>{{$precio.'€'}}</td>
			@endforeach
		</tr>
		@endforeach
	</table>
>>>>>>> 9e9b5c1a4017df9153430ec4497ab913f50f089d
@stop
