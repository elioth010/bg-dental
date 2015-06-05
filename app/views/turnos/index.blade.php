@extends('layouts.main')

@section('contenido')

<h1>Calendarios</h1>
<ul>
@foreach($sedes as $sede)

<li>{{HTML::linkAction('TurnoController@show', 'Turnos '.$sede->nombre, $sede->id) }}</li>
@endforeach
</ul>

@stop
