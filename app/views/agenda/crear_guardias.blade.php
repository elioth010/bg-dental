@extends('layouts.main')
 
@section('contenido')
{{ Form::open(array('url'=>'guardia'))}}

    <div>
    <h1>Creación de Guardias</h1>
    <ul class="labelreg4">
    <li>{{ Form::label('codigo', 'Código') }}</li>
    <li>{{ Form::label('especialidad', 'Nombre') }}</li>
    </div>

{{ Form::close() }}
    
@stop