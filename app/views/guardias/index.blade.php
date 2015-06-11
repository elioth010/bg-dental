@extends('layouts.main')

@section('title')
    Guardias
@stop

@section('contenido')

<h1>Elija una sede</h1>
<ul class="navi" style="margin-top:10px">
@foreach($sedes as $sede)
    <li>{{HTML::linkAction('GuardiaController@show', 'Guardias '.$sede->nombre, $sede->id, array('class' => 'btn')) }}</li>
@endforeach
</ul>

@stop
