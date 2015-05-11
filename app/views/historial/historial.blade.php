@extends('layouts.main')

@section('contenido')

  <div class="search">
  {{ HTML::linkAction('Historial_clinicoController@buscar', 'Buscar pacientes') }}
  </div>
  <div class="top">
  <h3>Historial de {{$paciente->nombre}}, {{$paciente->apellido1}} {{$paciente->apellido2}} con NHC:  {{$paciente->numerohistoria}} y Compañía: {{$compania->nombre}}</h3>
  	<div class="overflow">
    <table border = "1">
        <tr>
            
            <th>Tratamiento realizado</th>
            <th>Profesional</th>
            <th>Fecha realización</th>
            <th>Precio</th>
            <th>Cobrado paciente (si privado)</th>
            <th>Abonado por Quirón</th>
            <th>Cobrado por profesional</th>
        </tr>
        @foreach($historial as $historial)
        <tr>
            
            <td>{{ $historial->nombre }}</td>
            <td>{{ $historial->profesional_id }}</td>
            <td>{{ $historial->fecha_realizacion }}</td>
            <td>{{$historial->precio}}</td>
            <td>{{ $historial->cobrado_paciente }}</td>
            <td>{{ $historial->abonado_quiron }}</td>
            <td>{{ $historial->cobrado_profesional }}</td>
        </tr>
        @endforeach
         <tr>
            {{ Form::open(array('url'=>'historial_clinico')) }}
            <td>{{ Form::select('grupos', $grupos) }} {{ Form::select('tratamiento_id', $tratamientos) }}</td>
            <td>{{$profesional->nombre}}, {{$profesional->apellido1}}{{Form::hidden('profesional_id', $profesional->id)}}{{Form::hidden('paciente_id', $paciente->id)}}</td>
            <td><input type="date" name = "fecha_realizacion"/></td>
            <td>Precio...</td>
            <td>{{Form::number('cobrado_paciente')}}</td>
             <td>{{Form::number('abonado_quiron')}}</td>
             <td>{{Form::number('cobrado_profesional')}}</td>
            <td> {{ Form::submit('Guardar cambios', array('class'=>'botonl'))}}</td>
            {{ Form::close() }}
        </tr>
    </table>
           
            
	</div>
</div>

@stop
