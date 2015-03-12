@extends('layouts.main')

@section('contenido')
{{ Form::open(array('url'=>'tratamientos/guardar')) }}
    <h1>Creación de tratamientos:</h1>
    <ul class="labelreg6">
    <li>{{ Form::select('grupostratamientos_id', $grupos) }}</li>
    <li>{{ Form::text('codigo', null, array('placeholder'=>'código')) }}</li>
    <li>{{ Form::text('nombre', null, array('placeholder'=>'nombre')) }}</li>
    {{ Form::select('tipotratamiento', $tipostratamientos) }}
    <br><br>

    <table>
        <tr>
            <th>Compañía</th>
            <th>Precio<th>
        </tr>
        @foreach($companias as $compania)
        <tr>
            <td>
                {{$compania->nombre}}
                {{Form::hidden('cid-'.$compania->id, $compania->id)}}
            </td>
            <td>
                {{Form::text('precio-'.$compania->id)}}
            </td>
        </tr>
        @endforeach
    </table>
    <br><br>
    <li>{{Form::hidden('activo', '1')}}</li>
    <li>{{ Form::submit('Guardar', array('class'=>'botonl'))}}</li>

{{ Form::close() }}
@stop
	</ul>
