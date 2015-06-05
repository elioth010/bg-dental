@extends('layouts.main')

@section('contenido')
<h2>Guardias {{$sede->nombre}}</h2>
@if(Auth::user()->isAdmin())
{{HTML::linkAction('GuardiaController@editMonth', 'Editar guardias del mes', array($sede->id, $year, $month)) }}
@endif
{{ $calendario }}
@stop
