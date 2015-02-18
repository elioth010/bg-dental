@extends('layouts.main')

@section('contenido')
    <h1>Edición de tratamiento</h1>

        {{ Form::open(array('url'=>'tratamientos/guardartratamiento/'.$tratamiento->id)) }}

	<ul class="labelreg6">
       <li> {{Form::label('Código')}} {{ Form::text('codigo', $tratamiento->codigo ) }}
        {{ Form::text('nombre', $tratamiento->nombre) }}</li>
        <li>{{--@foreach($tcp as $tcp)
            {{Form::label($tcp['nombre_comp'])}}
            
            {{ Form::text('precio-'.$tcp['id'], $tcp['precio']) }}
        @endforeach --}}</li>
            {{ Form::select('grupostratamientos_id', $grupos, $tratamiento->grupostratamientos_id) }}
        
        <li>@foreach($tipos as $tipo)
        @if($tratamiento->tipostratamientos_id === $tipo->id)
        {{ Form::radio('tipotratamiento', $tipo->id, true)}}{{$tipo->tipo}}</li>
        @else
        <li>{{ Form::radio('tipotratamiento', $tipo->id)}} {{$tipo->tipo}}
        @endif
        @endforeach</li>
        <li>{{ Form::submit('Guardar cambios', array('class'=>'botonl'))}}</li><br>
        <li>{{ Form::button('Atrás')}} {{ HTML::link('tratamientos', 'Tratamientos') }}</li>

    {{ Form::close() }}
@stop
	</ul>