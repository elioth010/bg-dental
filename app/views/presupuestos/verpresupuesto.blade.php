@extends('layouts.main')

@section('title')
    Presupuesto
@stop

@section('contenido')

   	<div class="overflow">
    <h2>Presupuesto: {{ $presupuesto->nombre}}</h2>

    <h2>Tratamientos incluidos:</h2>
    <table>
      <tr>
        <th></th>
        <th>Nombre</th>
        <th>Unidades</th>
        <th>Precio unidad</th>
        <th>Descuento €</th>
        <th>Compañía</th>
        <th>Piezas</th>
        <th>Estado</th>
        <th>Precio final</th>
        <?php if ($presupuesto->aceptado) { ?>
        <th>Acciones</th>
        <?php } ?>
      </tr>
      <?php $i=1 ?>
      @foreach($tratamientos as $t)
      <tr>
        <td>{{ $i }}</td>
        <td>{{ $t->nombre }}</td>
        <td>{{ $t->unidades }}</td>
        <td>{{ $t->precio_unidad }}€</td>
        <td>{{ $t->descuento_text }}</td>
        <td>{{ $t->compania_text }}</td>
        <td>@if ($t->tipostratamientos_id == 4) Cuadrante @endif {{ $t->piezas }}</td>

        <td>
        <?php if ($presupuesto->aceptado) { ?>
            <?php if (!$t->estado) { ?>
                <span style="color: red">No realizado</span>
            <?php } else { ?>
                Realizado
            <?php } ?>
        <?php } else { ?>
            <span style="color: red">No aceptado aún</span>
        <?php } ?>
        </td>
        <td>{{ $t->precio_final }}€</td>
        <?php if ($presupuesto->aceptado) { ?>
        <td>
        <?php if (!$t->estado) { ?>
        {{ HTML::linkAction('PresupuestosController@aceptarTratamientoPresupuesto', 'Marcar como realizado',
                array($paciente, $presupuesto->id, $t->id)) }}
        <?php } ?>
        </td>
        <?php } ?>
      </tr>
      <?php $i++ ?>
      @endforeach
      <tr>
        <td><span class="bold">TOTAL:</span></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><span class="bold">{{ $total }}€</span></td>
      </tr>
    </table>

    {{ Form::open(array('action' => array('PresupuestosController@verPresupuesto', $presupuesto->numerohistoria, $presupuesto->id))) }}
        <div class="tbl_izq">
            <h2>Observaciones ocultas en el presupuesto:</h2>
            {{ Form::textarea('observaciones', $presupuesto->observaciones) }}
        </div>
        <div class="tbl_drc">
            <h2>Observaciones que saldrán en el presupuesto:</h2>
            {{ Form::textarea('observaciones_p', $presupuesto->observaciones_p) }}</br>
        </div>
        {{ Form::submit('Modificar', array('class'=>'botonl'))}}
    {{ Form::close() }}

    <div style="margin-top:30px;">
       <hr/>
    Acciones:

    {{ HTML::linkAction('PresupuestosController@verpresupuestos', 'Volver a los presupuestos de este paciente', $paciente) }}
  | {{ HTML::linkAction('PresupuestosController@imprimirPresupuesto', 'Imprimible', array($paciente, $presupuesto->id), ['target'=>'_blank']) }}
    | {{ HTML::linkAction('PresupuestosController@imprimirPDF', 'Descargar PDF', array($paciente, $presupuesto->id), ['target'=>'_blank']) }}
    | {{ HTML::linkAction('PresupuestosController@verPDF', 'Ver PDF', array($paciente, $presupuesto->id), ['target'=>'_blank']) }}
	</div>
	</div>
@stop
