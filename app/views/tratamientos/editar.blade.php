@extends('layouts.main')

@section('contenido')
    <h1>Edición de tratamiento</h1>

        {{ Form::open(array('url'=>'tratamientos/guardartratamiento/'.$tratamiento->id)) }}

	<ul class="labelreg6">
       <li> {{Form::label('Código')}} {{ Form::text('codigo', $tratamiento->codigo ) }}
        {{Form::label('Nombre')}}{{ Form::text('nombre', $tratamiento->nombre) }}</li>
       <table>
           <tr>
               
               
           
               
       @foreach($companias as $compania)
                <td>{{$compania}}</td>
       @endforeach
           </tr>
       
           
       <tr>
            
           @foreach($tcp as $tcp)
           <td>{{Form::hidden('cid-'.$tcp['id'])}}{{ Form::text('precio-'.$tcp['id'], $tcp['precio']) }}</td>
            @endforeach
            
       </tr>
        
       </table></br>
        {{Form::label('Grupo')}}{{ Form::select('grupostratamientos_id', $grupos, $tratamiento->grupostratamientos_id) }}
        </br>
        {{Form::label('Tipo')}}
        @foreach($tipos as $tipo)
        @if($tratamiento->tipostratamientos_id === $tipo->id)
        {{ Form::radio('tipotratamiento', $tipo->id, true)}}{{$tipo->tipo}}
        @else
        {{ Form::radio('tipotratamiento', $tipo->id)}} {{$tipo->tipo}}
        @endif
        
        @endforeach
        <li>{{ Form::submit('Guardar cambios', array('class'=>'botonl'))}}</li><br>
        <li>{{ Form::button('Atrás')}} {{ HTML::linkAction('TratamientosController@index', 'Tratamientos') }}</li>

    {{ Form::close() }}
@stop
	</ul>
