@extends('layouts.main')

@section('ceeseeses')
<style>
	tbody {
		height: 300px;
		overflow: auto;
	}

	td {
		padding: 3px 10px;
	}

	thead > tr, tbody {
		display:block;
	}
</style>
@stop

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
	    <thead>
	        <tr>
	            <td>Código</td>
	            <td>Nombre tratamiento</td>
				@foreach($companias as $compania)
				<td>{{ $compania }}</td>
				@endforeach
	        </tr>
	    </thead>
	    <tbody>
			@foreach($tratamientos as $tratamiento)
			<?php $precios = explode(",", $tratamiento->precios);
			// HACK para no mostrar los tratamientos sin precios
			if (!empty($precios[0])) {
			?>
			<tr title="{{ $tratamiento->nombre }}">

				<td>{{ $tratamiento->codigo }}</td>
				<td>{{ HTML::linkAction('TratamientosController@edit', $tratamiento->nombre, $tratamiento->id) }}</td>

				@foreach($precios as $precio)
				<td>{{ $precio.'€' }}</td>
				@endforeach
			</tr>
			<?php } ?>
			@endforeach
	    </tbody>
	</table>
>>>>>>> 9e9b5c1a4017df9153430ec4497ab913f50f089d
@stop
