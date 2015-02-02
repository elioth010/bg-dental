@extends('layouts.main')

@section('contenido')
    <h1>Edición de tratamiento</h1>

        {{ Form::open(array('url'=>'tratamientos/guardartratamiento/'.$tratamiento->id)) }}


        {{Form::label('Código')}}
        {{ Form::text('codigo', $tratamiento->codigo ) }}
        {{ Form::text('nombre', $tratamiento->nombre) }}<p>
        @foreach($tcp as $tcp)<li>
            {{Form::label($tcp['nombre_comp'])}}
            
            {{ Form::text('precio-'.$tcp['id'], $tcp['precio']) }}</li><br>
        @endforeach
        {{ Form::select('grupostratamientos_id', $grupos) }}
        {{ Form::submit('Guardar cambios')}}
        {{ Form::button('Atrás')}} {{ HTML::link('tratamientos', 'Tratamientos') }}

    {{ Form::close() }}
@stop