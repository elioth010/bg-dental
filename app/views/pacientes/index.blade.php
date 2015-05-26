@extends('layouts.main')

@section('contenido')

  <div class="search">
  {{ HTML::linkAction('PacientesController@buscar', 'Buscar pacientes') }}
  </div>
  <div class="top">
  <h3>Últimos pacientes creados:</h3>
  	<div class="labelreg6">
    <table border = "1">
        <tr>
            <th>NHC</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Admitidos</th>
        </tr>
        @foreach($pacientes as $paciente)
        <tr>
            <td>{{ HTML::linkAction('PacientesController@edit',  $paciente->numerohistoria, $paciente->id) }}</td>
            <td>{{ $paciente->nombre }}</td>
            <td>{{ $paciente->apellido1." ".$paciente->apellido2 }}</td>
            {{ Form::open(array('url'=>'espera/'.$paciente->id, 'method' => 'put')) }}
            <td>
                {{Form::select('profesional_id', $profesionales)}}
                
            </td>
            @if($paciente->admitido > 0)
            <td>{{Form::checkbox('admitido',1,1)}}{{Form::submit('OK')}}</td>
            @else
            <td>{{Form::checkbox('admitido',1,0)}}{{Form::submit('OK')}}</td>
            
            @endif
                {{Form::close()}}
        </tr>
        @endforeach
    </table>
	</div>
</div>
@stop
