@extends('layouts.main')

@section('contenido')
    @foreach($presupuesto as $pre)
        {{$pre->nombre_pre}}
    @endforeach
@stop