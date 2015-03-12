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
			<?php $precios = explode(",", $tratamiento->precios); ?>
			<tr title="{{ $tratamiento->nombre }}">

				<td>{{ $tratamiento->codigo }}</td>
				<td>{{ HTML::linkAction('TratamientosController@edit', $tratamiento->nombre, $tratamiento->id) }}</td>

				@foreach($precios as $precio)
				<?php if($precio == "NULL") { ?>
					<td style="color: red">NO DISPONIBLE</td>
				<?php } else { ?>
					<td>{{ $precio.'€' }}</td>
				<?php } ?>

				@endforeach
			</tr>
			@endforeach
	    </tbody>
	</table>
@stop
