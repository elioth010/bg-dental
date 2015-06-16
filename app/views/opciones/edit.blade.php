@extends('layouts.main')

@section('title')
    Editar opción
@stop

@section('contenido')
    <h1>Edición de Opciones</h1>

    {{ Form::open(array('url'=>'opciones/'.$opcion->id, 'method' => 'put')) }}

    <ul class="labelreg6" style="margin-bottom:10px;">
       <li> {{Form::label('Nombre:')}} {{ Form::text('nombre', $opcion->nombre ) }}</li>
       <li> {{Form::label('Valor:')}} {{ Form::text('valor', $opcion->valor ) }}</li>
       <li> {{Form::label('Descripción:')}} {{ Form::text('desc', $opcion->desc ) }}</li>
       <li> @if($opcion->oculto > 0)
           {{Form::label('Oculto:')}} {{ Form::checkbox('oculto', 1, true ) }}
           @else
           {{Form::label('Oculto:')}} {{ Form::checkbox('oculto', 0 ) }}

           @endif
       </li>
      
    <li>{{Form::submit('OK')}}</li>
            {{Form::close()}}
    </ul>
     {{ Form::open(array('url'=>'opciones/'.$opcion->id, 'method' => 'delete')) }}
    {{ Form::submit('Eliminar esta opción', array('class'=>'botonl'))}}

    {{ Form::close() }}


@stop
