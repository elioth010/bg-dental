@extends('layouts.main')

@section('contenido')

 
  <div class="top">
      <table>  
          <tr>
              <td>Facturación por intervalo de tiempo:
                  {{ Form::open(array('url'=>'facturacion/cf')) }}
                  {{ Form::text('fecha_inicio', '', array('id' => 'fecha_inicio', 'class' => 'euros')) }} - {{ Form::text('fecha_fin', '', array('id' => 'fecha_fin', 'class' => 'euros')) }}
                  {{ Form::submit('OK', array('class'=>'botonl'))}}
                  {{ Form::close() }}
              </td>
              <td>Facturación pendiente de cobro:
                  {{ Form::open(array('url'=>'facturacion/nocobrado')) }}
                  {{ Form::text('fecha_inicio', '', array('id' => 'fecha_inicio_nc', 'class' => 'euros')) }} - {{ Form::text('fecha_fin', '', array('id' => 'fecha_fin_nc', 'class' => 'euros')) }}
                  {{ Form::submit('OK', array('class'=>'botonl'))}}
                  {{ Form::close() }}                  
              </td>
          </tr>
      </table>
 <h3>Este mes:</h3>
  	<div class="labelreg6">
    <table border = "1">
        <tr>
            <th>Paciente</th>
            <th>Tratamiento</th>
            <th>Fecha de realización</th>
            <th>Costes lab.</th>
            <th>Producción s. Quirón</th>
            <th>Cobrado por profesional</th>
            
        </tr>
        <?php $i = 1;?>
        
        @foreach($historiales as $historial)
            <tr>
                <td>{{ HTML::link('historial_clinico/'.$historial->p_id, $historial->p_n.', '.$historial->p_a1.' '.$historial->p_a2)}} </td>
                <td>{{$historial->t_n }}</td>
                <td class = "td_centrado">{{$historial->fecha_realizacion}}</td>
                {{ Form::open(array('url'=>'facturacion/'.$historial->h_id, 'method' => 'put')) }}
                {{Form::hidden('id-'.$i, $historial->h_id)}}
                <td>{{Form::number('coste_lab-'.$i, null, array('class' => 'euros', 'step' => 'any'))}}</td>
                    <td class = "td_centrado">
                        @if(Auth::user()->isAsesor())
                            @if($historial->abonado_quiron != 1)
                                {{Form::checkbox('abonado_quiron-'.$i)  }}
                            @else
                                {{Form::checkbox('abonado_quiron-'.$i,1, true)  }}
                            @endif
                        @else
                            @if($historial->abonado_quiron != 1)
                                {{Form::checkbox('abonado_quiron-'.$i, 0,null,array('disabled'))  }}
                            @else
                                {{Form::checkbox('abonado_quiron-'.$i,1, true, array('disabled'))  }}
                            @endif
                        @endif
                    </td>

                    <td class = "td_centrado">
                        @if(Auth::user()->isAsesor())
                            @if($historial->cobrado_profesional != 1)
                                {{Form::checkbox('cobrado_profesional-'.$i, 0,null,array('disabled'))  }}
                            @else
                                {{Form::checkbox('cobrado_profesional-'.$i,1, true, array('disabled'))  }}
                            @endif
                        @else
                            @if($historial->cobrado_profesional != 1)
                                {{Form::checkbox('cobrado_profesional-'.$i)  }}
                            @else
                                {{Form::checkbox('cobrado_profesional-'.$i,1, true)  }}
                            @endif
                        @endif
                    </td>
                    <td> 
            </tr><?php $i++;?>
        @endforeach
        </td>
                
    </table>{{ Form::submit('Guardar cobros', array('class'=>'botonl'))}}{{Form::close()}}
	</div>
</div>
@stop
