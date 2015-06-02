@extends('layouts.main')

@section('contenido')
<h2>Turnos {{$sede->nombre}}</h2>
{{ $calendario }}

@if(Auth::user()->isAdmin())
{{HTML::linkAction('TurnoController@edit', 'Modificar turnos', $sede->id) }}
@endif
@stop
