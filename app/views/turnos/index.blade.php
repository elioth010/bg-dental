@extends('layouts.main')

@section('contenido')

<h1>Elija una sede</h1>
<ul class="navi" style="margin-top:10px">
@foreach($sedes as $sede)
    <li>{{HTML::linkAction('TurnoController@show', 'Turnos '.$sede->nombre, $sede->id, array('class' => 'btn')) }}</li>
@endforeach
</ul>

<h2 style="margin-top:30px">Incidencias</h2>
<ul>
    <li style="margin:5px 0 0 10px">{{HTML::linkAction('TurnoController@incidencias', 'Ver incidencias ', array(), array('class' => 'btn')) }}</li>
</ul>
@stop
