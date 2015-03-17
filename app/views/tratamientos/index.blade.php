@extends('layouts.main')

@section('ceeseeses')
<style>
	tbody {
		height: 330px;
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
	    <tbody>
	        <tr>
	            <th style="width: 96px">Código</th>
	            <th style="width: 287px">Nombre tratamiento</th>
				@foreach($companias as $compania)
				<th style="width: 67px">{{ $compania }}</th>
				@endforeach
	        </tr>
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
		<table>
	    <thead>
	        <tr>
	            <th style="width: 96px">Código</th>
	            <th style="width: 287px">Nombre tratamiento</th>
				@foreach($companias as $compania)
				<th style="width: 67px">{{ $compania }}</th>
				@endforeach
	        </tr>
		</thead>
		</table>
@stop
