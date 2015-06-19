@extends('layouts.main')

@section('title')
    Tratamientos
@stop

@section('contenido')
	<div class="overflow">
    <h1>Búsqueda de tratamientos</h1>

    {{ Form::open(array('url'=>'tratamientos/busqueda', 'method' => 'get')) }}
        {{ Form::text('nombre', $q_nombre, array('placeholder'=>'Nombre', 'autofocus' => '')) }}
        {{ Form::text('codigo', $q_codigo, array('placeholder'=>'Código Quirón')) }}
        {{ Form::submit('Buscar')}}
    {{ Form::close() }}
    <br/>

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

	</div>
@stop
