@extends('layouts.main')

@section('title')
    Historial clínico
@stop

@section('javascripts')
    <script src="/js/historial.js"></script>
@stop

@section('contenido')

  <div class="search">
  {{ HTML::linkAction('Historial_clinicoController@index', 'Buscar pacientes') }}
  </div>
  <div>
  <h3>Historial de {{ $paciente->nombre}}, {{ $paciente->apellido1 }} {{ $paciente->apellido2 }}</h3>
  <h3>NHC: {{ HTML::linkAction('PacientesController@show',$paciente->numerohistoria, $paciente->id) }} </h3>
  <h3>Compañías: {{ $paciente->companias_text }}</h3>
  <div class="roll">
   
  @if ($espera_id != 0)
  {{ Form::open(array('url'=>'espera/'.$espera_id, 'method' => 'put')) }}
  {{ Form::submit('Finalizar visita', array('class'=>'botonl')) }}
  {{ Form::close() }}
  @endif

  @if(Auth::user()->isAdmin() or Auth::user()->isRecepcion())
      @if($paciente->saldo < 0)
              <h2>Saldo: <span style = "color :red"> {{$saldo}} €</span>
      @else
              <h2>Saldo: <span style = "color: green"> {{$saldo}} €</span>
      @endif
      {{ Form::open(array('url'=>'cobros/anticipo/'.$paciente->id)) }}
      {{Form::hidden('paciente_id', $paciente->id)}}
      {{Form::number('anticipar' ,'0,00',  array('class' => 'euros', 'step' => 'any'))}}
      {{Form::select('tipos_de_cobro_id', $tipos_de_cobro)}}
      {{ Form::submit('Cobrar anticipo', array('class'=>'botonl'))}}
      {{ Form::close() }}


        @if($p_d_c->pendiente > 0)
            Importe pendiente de cobro: <span style = "color :red"> {{$p_d_c->pendiente}} €</span></h2>
        @else
            <span style = "color: green"> {{'No existen tratamientos pendientes de cobro'}}</span></h2>
        @endif
  @endif
	<div class="roll">
    <h2>Presupuestos aceptados:</h2>


        <?php if (empty($presupuestos)) { ?>
            El paciente no tiene presupuestos aceptados.
        <?php } else { ?>

            {{--<p>Marque un tratamiento de un presupuesto aceptado para añadirlo al historial del paciente:</p>--}}
        <div>

        @foreach($presupuestos as $presupuesto)

        <?php if (!empty($presupuesto->presu_tratamientos)) { ?>
        <h3>{{ HTML::linkAction('PresupuestosController@verPresupuesto',
                $presupuesto->nombre . ' (' . $presupuesto->creado . ')',
                array($paciente->numerohistoria, $presupuesto->id), array('target' => '_blank')) }}</h3>

        <table border = "1">
            <tr>
                <th>Tratamiento</th>
                <th>Profesional</th>
                <th>Fecha realización</th>
                <th>Precio</th>
                <th>Guardar</th>
            </tr>

        @foreach($presupuesto->presu_tratamientos as $tratamiento)
            <tr>
                {{ Form::open(array('url'=>'historial_clinico')) }}
                {{ Form::hidden('profesional_id', $profesional->id) }}
                {{ Form::hidden('paciente_id', $paciente->id) }}
                {{ Form::hidden('tratamiento_id', $tratamiento->tratamiento_id) }}
                {{ Form::hidden('precio', $tratamiento->precio_final) }}
                {{ Form::hidden('presupuesto_id', $presupuesto->id) }}
                {{ Form::hidden('presupuestotratamiento_id', $tratamiento->id) }}
                <td>{{ $tratamiento->nombre }}</td>
                <td>{{ $profesional->nombre }}, {{ $profesional->apellido1 }}</td>
                <td>{{ Form::text('fecha_realizacion', '', array('class' => 'datepicker')) }}</td>
                <td>{{ $tratamiento->precio_final }}</td>
                @if ($tratamiento->estado == 0)
                <td> {{ Form::submit('Añadir', array('class'=>'botonl'))}}</td>
                @else
                <td></td>
                @endif
                {{ Form::close() }}
            </tr>
        @endforeach

        </table>
        <?php } ?>
        @endforeach

        </div>
        <?php } ?>
            <br>
    <table border = "1">
        <tr>

            <th>ID hist.</th>
            <th>Tratamiento realizado</th>
            <th>Profesional</th>
            <th>Fecha realización</th>
            <th>Precio</th>
            {{--@if(Auth::user()->isAdmin() or Auth::user()->isRecepcion())
            <th>Cobrado paciente</th>
            <th>Costes lab.</th>
            @endif --}}

<!--            <th>Abonado por Quirón</th>
            <th>Cobrado por profesional</th>-->
            <th>Añadir</th>
            @if(Auth::user()->isAdmin() or Auth::user()->isRecepcion())
            <th>Costes lab.</th>
            @endif
        </tr>

        <tr>
            <td></td>
            {{ Form::open(array('url'=>'historial_clinico')) }}
            {{ Form::hidden('profesional_id', $profesional->id) }}
            {{ Form::hidden('paciente_id', $paciente->id) }}

            <td>{{ Form::select('s_grupos', array(),  null, array('id' => 's_grupos', 'onchange' => 'updateSelectTratamientos(this.value)')) }}
                {{ Form::select('tratamiento_id', array(), null, array('id' => 's_tratamientos', 'onchange' => 'updatePrecios()')) }}
            </td>
            <td>{{ $profesional->nombre }}, {{ $profesional->apellido1 }} {{ $profesional->apellido2 }}</td>
            <td>{{ Form::text('fecha_realizacion', '', array('class' => 'datepicker')) }}</td>

            <td>{{ Form::select('precio', array(), null, array('id' => 's_precios')) }}</td>



            @if(Auth::user()->isAdmin() or Auth::user()->isRecepcion())
            {{--<td>{{Form::number('cobrado_paciente', null, array('class' => 'euros', 'step' => 'any'))}}</td>
            <td>{{Form::number('coste_lab', null, array('class' => 'euros', 'step' => 'any'))}}</td>--}}
            @endif

<!--             <td class = "td_centrado">{{ Form::checkbox('abonado_quiron',0,0) }}</td>
             <td class = "td_centrado">{{Form::checkbox('cobrado_profesional',0,0)}}</td>-->

            <td> {{ Form::submit('Añadir', array('class'=>'botonl'))}}</td>
            {{ Form::close() }}
        </tr>

        @foreach($historiales as $historial)
        <tr>
            <td>{{$historial->id}}</td>
            <td>
                <?php $grupos_q = array(158,159,160,161,162,163,164);
                ?>
                @if($historial->ayudantia_aplicada != 0 )
                    {{ $historial->t_n }} Ayudantía aplicada en ID: {{$historial->ayudantia_aplicada}}
                @elseif($historial->ayudantia != 1 && in_array($historial->t_id, $grupos_q))
                    {{ $historial->t_n }}
                    {{--Añadir ayudantía. Se copia la misma línea del historial con esa id pero el precio se disminuye un "100% - opción ayudantía" en tabla opciones.--}}
                    {{ Form::open(array('url'=>'historial_clinico/ayudantia')) }}
                    {{ Form::hidden('profesional_id', $profesional->id) }}
                    {{ Form::hidden('paciente_id', $paciente->id) }}
                    {{ Form::hidden('tratamiento_id', $historial->tratamiento_id) }}
                    {{ Form::hidden('fecha_realizacion', $historial->fecha_realizacion) }}
                    {{ Form::hidden('precio', $historial->precio) }}
                    {{ Form::hidden('id_hist_ayudantia', $historial->id) }}
                    {{ Form::submit('Añadir ayudantía', array('class'=>'botonl'))}}
                    {{ Form::close() }}
                @elseif($historial->id_hist_ayudantia != 0)
                    {{ $historial->t_n }} Ayudantía de ID: {{$historial->id_hist_ayudantia}}
                @else
                    {{ $historial->t_n }}
                @endif

            </td>
            <td>{{ $historial->pr_n}}, {{ $historial->pr_a1}} {{ $historial->pr_a2}}</td>
            <td>{{ $historial->date }}</td>
            <td>{{ $historial->precio}} €
                        @if($historial->pdc > 0)
                            pdc. {{ $historial->pdc }} €
                        @else
                            
                        @endif
            </td>
            @if (Auth::user()->isAdmin() or Auth::user()->isRecepcion())
            <td>@if(Auth::user()->isAdmin() or Auth::user()->isRecepcion())
                @if($historial->pendiente_de_cobro != 1)
                    {{'Cobrado'}}
                @else
                    {{ Form::open(array('url'=>'cobros')) }}
                    {{Form::number('cobrar' ,'',  array('class' => 'euros', 'step' => 'any', 'placeholder' => $historial->precio))}}
                    {{Form::select('tipos_de_cobro_id', $tipos_de_cobro)}}
                    {{Form::hidden('paciente_id', $paciente->id)}}
                    {{Form::hidden('historial_clinico_id', $historial->id)}}
                    {{ Form::submit('Cobrar', array('class'=>'botonl'))}}
                    {{ Form::close() }}
                @endif
                @endif
            </td>
            @endif
            @if(Auth::user()->isAdmin() or Auth::user()->isRecepcion())
            <td>@if($historial->coste_lab > 0)
                {{ $historial->coste_lab}} €
                @else
                {{ Form::open(array('url'=>'historial_clinico/coste_lab/'.$historial->id)) }}
                {{Form::number('coste_lab', null, array('class' => 'euros', 'step' => 'any'))}}
                {{ Form::submit('Añadir coste lab.', array('class'=>'botonl'))}}
                {{ Form::close() }}
                @endif
            </td>
            @endif
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


	</div>
</div>
</div>

<script type="text/javascript">
    var grupos = {{ json_encode($grupos) }}
    var tratamientos = {{ json_encode($atratamientos) }}
    var companias = {{ json_encode($companias) }}

    $(document).ready(function() {
        $(".datepicker").datepicker({dateFormat: "dd/mm/yy"}).datepicker("setDate",new Date());
        setTratamientos();
    });
</script>

@stop
