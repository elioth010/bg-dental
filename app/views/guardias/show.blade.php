@extends('layouts.main')

@section('title')
    Guardias
@stop

@section('contenido')
<div class="roll">
<h2>Guardias {{$sede->nombre}}</h2>
@if(Auth::user()->isAdmin()) <br>
<span style="margin:5px 0">{{HTML::linkAction('GuardiaController@editMonth', 'Editar guardias del mes', array($sede->id, $year, $month), array('class' => 'btn')) }}</span>
@endif
<p>{{ $calendario }}</p>
@stop
</div>
