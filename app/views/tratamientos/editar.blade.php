@extends('layouts.main')

@section('contenido')
    <h1>Edición de tratamiento</h1>

    {{ Form::open(array('url'=>'tratamientos/guardartratamiento/'.$tratamiento->id)) }}

	<ul class="labelreg6" style="margin-bottom:10px;">
       <li> {{Form::label('Código:')}} {{ Form::text('codigo', $tratamiento->codigo ) }}
        {{Form::label('Nombre:')}} {{ Form::text('nombre', $tratamiento->nombre) }}</li>
    </ul>
    <div style="margin-left:100px;">
    <br>
       <table>
           <tr>

            @foreach($companias as $compania)
                <td>{{$compania}}</td>
            @endforeach
           </tr>
           <tr>
            @foreach($precios as $tcp)
                <td>{{ Form::hidden('cid-'.$tcp['cid'], $tcp['cid']) }}
                    {{ Form::checkbox('activado-'.$tcp['cid'], '1', !$tcp['disabled'], array('onclick' => 'document.getElementsByName("precio-'. $tcp['cid'] . '")[0].disabled = !this.checked;')) }}
                    <?php if ($tcp['disabled']) { ?>
                        {{ Form::text('precio-'.$tcp['cid'], $tcp['precio'], array('size' => 5, 'disabled' => 1)) }}
                    <?php } else { ?>
                        {{ Form::text('precio-'.$tcp['cid'], $tcp['precio'], array('size' => 5)) }}
                    <?php } ?>
                </td>
            @endforeach
            </tr>
       </table>
       <br/>
        {{Form::label('Grupo:')}} {{ Form::select('grupostratamientos_id', $grupos, $tratamiento->grupostratamientos_id) }}
        <br/><br>

        {{Form::label('Tipo:')}}
        @foreach($tipos as $tipo)
            @if($tratamiento->tipostratamientos_id === $tipo->id)
            {{ Form::radio('tipotratamiento', $tipo->id, true)}}{{$tipo->tipo}}
            @else
            {{ Form::radio('tipotratamiento', $tipo->id) }}{{$tipo->tipo}}
            @endif
        @endforeach
        <br/><br>Imagen: {{ Form::select('imagen_id', $imagenes) }}
          Quirófano: @if($tratamiento->quirofano != 1)
        {{Form::checkbox('quirofano')}}
        @else
        {{Form::checkbox('quirofano', 1, true)}}
        @endif

        <br><br>{{ Form::submit('Guardar cambios', array('class'=>'botonl'))}}<br>
        <br>{{ HTML::link('tratamientos/borrartratamiento/'.$tratamiento->id, 'Eliminar este tratamiento') }}<br>
        {{ HTML::linkAction('TratamientosController@index', 'Volver a tratamientos') }}<br>

    {{ Form::close() }}
    </div>
@stop
