@extends('layouts.main')

@section('title')
    Editar tratamiento
@stop

@section('javascripts')
<script src="/js/bgdental.js"></script>
@stop

@section('contenido')
<div>
    <h1>Edición de tratamiento</h1>

    {{ Form::open(array('url'=>'tratamientos/guardartratamiento/'.$tratamiento->id)) }}

	<ul class="labelreg6" style="margin-bottom:10px;">
       <li> {{Form::label('Código:')}} {{ Form::text('codigo', $tratamiento->codigo ) }}
        {{Form::label('Nombre:')}} {{ Form::text('nombre', $tratamiento->nombre) }}</li>
    </ul>
</div>
    <br>
    <div style="margin-left:100px;width:850px; overflow:auto;">
       <table>
           <tr>

            @foreach($companias as $compania)
                <th>{{$compania}}</th>
            @endforeach
           </tr>
           <tr>
            @foreach($precios as $tcp)
                <td>{{ Form::hidden('cid-'.$tcp['cid'], $tcp['cid']) }}
                    {{ Form::checkbox('activado-'.$tcp['cid'], '1', !$tcp['disabled'], array('onclick' => 'document.getElementsByName("precio-'. $tcp['cid'] . '")[0].disabled = !this.checked;')) }}
                    <?php if ($tcp['disabled']) { ?>
                        {{ Form::text('precio-'.$tcp['cid'], number_format($tcp['precio'], 2, ',', '.'), array('size' => 5, 'disabled' => 1)) }}
                    <?php } else { ?>
                        {{ Form::text('precio-'.$tcp['cid'], number_format($tcp['precio'], 2, ',', '.'), array('size' => 5)) }}
                    <?php } ?>
                </td>
            @endforeach
            </tr>
       </table>
       </div>
       <div>
       	<ul class="labelreg6">
        <li>{{Form::label('Grupo:')}} {{ Form::select('grupostratamientos_id', $grupos, $tratamiento->grupostratamientos_id) }}
        </li>

        <li>{{Form::label('Tipo:')}}
        @foreach($tipos as $tipo)
            @if($tratamiento->tipostratamientos_id === $tipo->id)
            {{ Form::radio('tipotratamiento', $tipo->id, true)}}{{$tipo->tipo}}
            @else
            {{ Form::radio('tipotratamiento', $tipo->id) }}{{$tipo->tipo}}
            @endif
        @endforeach</li>
        <li>Imagen: {{ Form::select('imagen_id', $imagenes, $imgselected) }}</li>
        <li>Quirófano:{{ Form::checkbox('quirofano', 1, $tratamiento->quirofano == 1) }}</li>
        <li>Historiable:{{ Form::checkbox('historiable', 1, $tratamiento->historiable == 1) }}</li>

        <br><li>{{ Form::submit('Guardar cambios', array('class'=>'botonl'))}}</li><br>
        <li>{{ HTML::linkAction('TratamientosController@destroy', 'Eliminar este tratamiento', $tratamiento->id, array('class'=>'btn', 'onclick' => 'return confirm_eliminar();')) }}</li><br>
        <li>{{ HTML::linkAction('TratamientosController@index', 'Volver a tratamientos', array(), array('class'=>'btn')) }}</li>
        </ul>

    {{ Form::close() }}
    </div>
@stop
