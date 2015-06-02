@extends('layouts.main')

@section('contenido')

<h1>Calendarios</h1>
<ul>
@foreach($sedes as $sede)

<li>{{HTML::linkAction('TurnoController@show', 'Turnos '.$sede->nombre, $sede->id) }} -
@if(Auth::user()->isAdmin())
{{HTML::linkAction('TurnoController@edit', 'Modificar turnos', $sede->id)}}
@endif
</li>
@endforeach
</ul>

@stop
