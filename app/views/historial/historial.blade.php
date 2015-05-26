@extends('layouts.main')

@section('javascripts')
    <script src="/js/historial.js"></script>
@stop

@section('contenido')

  <div class="search">
  {{ HTML::linkAction('Historial_clinicoController@buscar', 'Buscar pacientes') }}
  </div>
  <div class="top">
  <h3>Historial de {{ $paciente->nombre}}, {{  $paciente->apellido1 }} {{ $paciente->apellido2 }} con NHC: {{ $paciente->numerohistoria }} y Compañías: {{ $paciente->companias_text }}</h3>
  	<div class="overflow">
    <table border = "1">
        <tr>

            <th>Tratamiento realizado</th>
            <th>Profesional</th>
            <th>Fecha realización</th>
            <th>Precio</th>

            @if(Auth::user()->isAdmin())
            <th>Cobrado paciente</th>
            @endif

<!--            <th>Abonado por Quirón</th>
            <th>Cobrado por profesional</th>-->
            <th>Guardar</th>
        </tr>

        <tr>
            {{ Form::open(array('url'=>'historial_clinico')) }}
            {{ Form::hidden('profesional_id', $profesional->id) }}
            {{ Form::hidden('paciente_id', $paciente->id) }}

            <td>{{ Form::select('s_grupos', array(),  null, array('id' => 's_grupos', 'onchange' => 'updateSelectTratamientos(this.value)')) }}
                {{ Form::select('s_tratamientos', array(), null, array('id' => 's_tratamientos')) }}
            </td>
            <td>{{ $profesional->nombre }}, {{ $profesional->apellido1 }}</td>
            <td>{{ Form::text('fecha_realizacion', '', array('id' => 'datepicker', 'class' => 'euros')) }}</td>
            <td>Precio...</td>

            @if(Auth::user()->isAdmin())
            <td>{{Form::number('cobrado_paciente', null, array('class' => 'euros', 'step' => 'any'))}}</td>
            @endif

<!--             <td class = "td_centrado">{{ Form::checkbox('abonado_quiron',0,0) }}</td>
             <td class = "td_centrado">{{Form::checkbox('cobrado_profesional',0,0)}}</td>-->

            <td> {{ Form::submit('Añadir', array('class'=>'botonl'))}}</td>
            {{ Form::close() }}
        </tr>

        @foreach($historiales as $historial)
        <tr>

            <td>{{ $historial->t_n }}</td>
            <td>{{ $historial->pr_n}}, {{ $historial->pr_a1}} {{ $historial->pr_a2}}</td>
            <td>{{ $historial->fecha_realizacion }}</td>
            <td>{{ $historial->precio }}</td>
            @if (Auth::user()->isAdmin())
            <td>{{ $historial->cobrado_paciente }}</td>
            @endif
            <td></td>
<!--            <td class = "td_centrado">
                @if($historial->abonado_quiron != 1)
                {{Form::checkbox('vacio',0,null, array('disabled'))  }}
                @else
                {{Form::checkbox('vacio',1, 1, array('disabled'))  }}
                @endif
            </td>
            <td class = "td_centrado">
                @if($historial->cobrado_profesional != 1)
                {{Form::checkbox('vacio',0,null, array('disabled'))  }}
                @else
                {{Form::checkbox('vacio',1, 1, array('disabled'))  }}
                @endif
            </td>-->
        </tr>
        @endforeach

    </table>
    <br/>
    <h2>Presupuestos abiertos</h2>
    Marque un tratamiento de un presupuesto abierto para añadirlo al historial del paciente:
	</div>
</div>

<script type="text/javascript">
    var grupos = {{ json_encode($grupos) }}
    var tratamientos = {{ json_encode($atratamientos) }}

    $(document).ready(function() {
        $("#datepicker").datepicker({dateFormat: "dd/mm/yy"}).datepicker("setDate",new Date());
        setTratamientos()
    });
</script>

@stop
