@extends('layouts.main')
@include('includes.buscar_p')

@section('contenido')
@yield('buscar_p')
<div class="overflow">
<h1>Paciente:</h1>

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
        <td> {{ $paciente->nombre }}</td>
        <td> {{ $paciente->apellido1." ".$paciente->apellido2 }}</td>
         {{ Form::open(array('url'=>'espera/'.$paciente->id, 'method' => 'put')) }}
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
@stop
