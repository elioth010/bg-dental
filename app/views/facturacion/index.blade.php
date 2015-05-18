@extends('layouts.main')

@section('contenido')

 
  <div class="top">
  <h3>Este mes:</h3>
  	<div class="labelreg6">
    <table border = "1">
        <tr>
            <th>Paciente</th>
            <th>Tratamiento</th>
            <th>Fecha de realización</th>
            <th>Abonado por Quirón</th>
            <th>Cobrado por profesional</th>
            <th>Guardar</th>
        </tr>
        <?php $i = 1;?>
        
        @foreach($historiales as $historial)
            <tr>
                <td>{{ HTML::link('historial_clinico/'.$historial->p_id, $historial->p_n.', '.$historial->p_a1.' '.$historial->p_a2)}} </td>
                <td>{{$historial->t_n }}</td>
                <td class = "td_centrado">{{$historial->fecha_realizacion}}</td>
                {{ Form::open(array('url'=>'facturacion/'.$historial->h_id, 'method' => 'put')) }}
                {{Form::hidden('id', $historial->h_id)}}
                    <td class = "td_centrado">
                        @if($historial->abonado_quiron != 1)
                        {{Form::checkbox('abonado_quiron-'.$i)  }}
                        @else
                        {{Form::checkbox('abonado_quiron-'.$i,1, true)  }}
                        @endif
                    </td>

                    <td class = "td_centrado">
                        @if($historial->cobrado_profesional != 1)
                        {{Form::checkbox('cobrado_profesional-'.$i)  }}
                        @else
                        {{Form::checkbox('cobrado_profesional-'.$i,1, true)  }}
                        <?php $i++;?>
                        @endif
                    </td>
                    <td> 
            </tr>
        @endforeach
        {{ Form::submit('OK', array('class'=>'botonl'))}}</td>
                {{Form::close()}}
    </table>
	</div>
</div>
@stop
