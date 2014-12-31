@extends('layouts.main')

@section('contenido')
    <h1>Edición de tratamiento</h1>

        {{ Form::open(array('url'=>'tratamientos/guardartratamiento/'.$tratamiento->id)) }}

        {{Form::label('Código') }}
        {{ Form::text('codigo', $tratamiento->codigo ) }}
        {{ Form::text('nombre', $tratamiento->nombre) }}<p>
        @foreach($tcp as $t)<li>
            {{ Form::label($t['compania']) }}
            {{ Form::text('precio_comp-'.$t['id'], $t['precio']) }}</li><br>
        @endforeach

        {{ Form::submit('Guardar cambios') }}
        {{ Form::button('Atrás')}} {{ HTML::link('tratamientos', 'Tratamientos') }}

    {{ Form::close() }}
@stop
