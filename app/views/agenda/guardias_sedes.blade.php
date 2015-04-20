@extends('layouts.main')
 
@section('contenido')
<h2>Turnos {{$sede->nombre}}</h2>
{{ $calendario }}
@stop