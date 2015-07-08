@extends('layouts.main')

@section('title')
    Editar opción
@stop

@section('javascripts')
<script src="/js/bgdental.js"></script>
@stop

@section('contenido')
    <h1>Edición de Opciones</h1>

    {{ Form::open(array('url'=>'opciones/'.$opcion->id, 'method' => 'put')) }}

    <ul class="labelreg6" style="margin-bottom:10px;">
       <li> {{Form::label('Nombre:')}} {{ Form::text('nombre', $opcion->nombre ) }}</li>
       <li> {{Form::label('Valor:')}} {{ Form::text('valor', $opcion->valor ) }}</li>
       <li> {{Form::label('Descripción:')}} {{ Form::text('desc', $opcion->desc ) }}</li>
       <li> {{Form::label('Oculto:')}} {{ Form::checkbox('oculto', 1, $opcion->oculto == 1 ) }}</li>

        <li>{{Form::submit('OK')}}</li>
            {{Form::close()}}
    </ul>
    {{ Form::open(array('url'=>'opciones/'.$opcion->id, 'method' => 'delete', 'onsubmit' => 'return confirm_eliminar();')) }}
    {{ Form::submit('Eliminar esta opción', array('class'=>'botonl'))}}

    {{ Form::close() }}


@stop
