@extends('layouts.main')

@section('contenido')
    <h1>Edición de compañía</h1>

    {{ Form::open(array('url'=>'tratamientos/modificarcompania/'.$compania->id)) }}

	<ul class="labelreg6" style="margin-bottom:10px;">
       <li> {{Form::label('Código:')}} {{ Form::text('codigo', $compania->codigo ) }}
        {{Form::label('Nombre:')}} {{ Form::text('nombre', $compania->nombre) }}</li>
    </ul>
     <br>{{ HTML::link('tratamientos/borrarcompania/'.$compania->id, 'Eliminar esta compañía') }}<br>
    {{ Form::submit('Guardar cambios', array('class'=>'botonl'))}}
    
    {{ Form::close() }}




@stop