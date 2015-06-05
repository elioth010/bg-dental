@extends('layouts.main')

@section('contenido')

<h1>Elija una sede</h1>
<ul>
@foreach($sedes as $sede)
    <li>{{HTML::linkAction('GuardiaController@show', 'Guardias '.$sede->nombre, $sede->id) }}</li>
@endforeach
</ul>

@stop
