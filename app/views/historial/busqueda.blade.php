@extends('layouts.main')

@section('title')
    Historial clínico
@stop

@section('contenido')
<div class="overflow">

<h1>Búsqueda de pacientes:</h1>
@if (count($pacientes) > 0)
<table border = "1">
    <tr>
        <th>NHC</th>
        <th>Nombre</th>
        <th>Apellidos</th>
    </tr>

    @foreach($pacientes as $paciente)
    <tr>
        <td> {{ HTML::linkAction('Historial_clinicoController@show', $paciente->numerohistoria, $paciente->id) }}</td>
        <td> {{ $paciente->nombre }}</td>
        <td> {{ $paciente->apellido1." ".$paciente->apellido2 }}</td>
    </tr>
    @endforeach

</table>
</div>
@else
La búsqueda no produjo ningún resultado.
<br/>
<br/>
@endif

<div>
{{ HTML::linkAction('Historial_clinicoController@index', 'Volver a historial clínico') }}
</div>
@stop
