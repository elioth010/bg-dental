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
        @foreach($historiales as $historial)
        <tr>
            <td>{{ HTML::link('historial_clinico/'.$historial->p_id, $historial->p_n.', '.$historial->p_a1.' '.$historial->p_a2)}} </td>
            <td>{{$historial->t_n }}</td>
            <td class = "td_centrado">{{$historial->fecha_realizacion}}</td>
            {{ Form::open(array('url'=>'facturacion/'.$historial->id, 'method' => 'put')) }}
            <td class = "td_centrado">
                @if($historial->abonado_quiron != 1)
                {{Form::checkbox('abonado_quiron')  }}
                @else
                {{Form::checkbox('abonado_quiron',1, true)  }}
                @endif
            </td>
            
            <td class = "td_centrado">
                @if($historial->cobrado_profesional != 1)
                {{Form::checkbox('cobrado_profesional')  }}
                @else
                {{Form::checkbox('cobrado_profesional',1, true)  }}
                @endif
            </td>
            <td> {{ Form::submit('OK', array('class'=>'botonl'))}}</td>
            {{Form::close()}}
        </tr>
        @endforeach
    </table>
	</div>
</div>
@stop
