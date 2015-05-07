@extends('layouts.main')

@section('contenido')
<div class="overflow">
<h1>Paciente:</h1>

<table border = "1">
    <tr>
        <th>NHC</th>
        <th>Nombre</th>
        <th>Apellidos</th>
    </tr>

    @foreach($paciente as $paciente)
    <tr>
        <td> {{ HTML::linkAction('Historial_clinicoController@show', $paciente->numerohistoria, $paciente->id) }}</td>
        <td> {{ $paciente->nombre }}</td>
        <td> {{ $paciente->apellido1." ".$paciente->apellido2 }}</td>
    </tr>
    @endforeach

</table>
</div>
@stop
