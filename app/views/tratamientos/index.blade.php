@extends('layouts.main')

@section('contenido')
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

@stop
