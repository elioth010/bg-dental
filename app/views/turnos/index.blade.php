@extends('layouts.main')

@section('contenido')

<h1>Elija una sede</h1>
<ul>
@foreach($sedes as $sede)
    <li>{{HTML::linkAction('TurnoController@show', 'Turnos '.$sede->nombre, $sede->id) }}</li>
@endforeach
</ul>

<h2>Incidencias</h2>
<ul>
    <li>{{HTML::linkAction('TurnoController@incidencias', 'Ver incidencias ') }}</li>
</ul>
@stop
