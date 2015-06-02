@extends('layouts.main')

@section('contenido')
<h2>Turnos en la sede {{ $sede->nombre }} ({{ $fecha }})</h2>

@if(Auth::user()->isAdmin())
{{HTML::linkAction('TurnoController@edit', 'Modificar turnos', $sede->id) }}
@endif
{{ $calendario }}

@stop
