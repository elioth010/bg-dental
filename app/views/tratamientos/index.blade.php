@extends('layouts.main')

@section('contenido')
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
@stop
