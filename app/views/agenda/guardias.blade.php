@extends('layouts.main')
 
@section('contenido')
<h2>Guardias {{$sede->nombre}}</h2>
{{ $calendario }}
@stop