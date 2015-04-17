@extends('layouts.main')

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
        <td>{{ $t->piezas }}</td>

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

    <h2>Observaciones:</h2>


    {{ Form::open(array('action' => array('PresupuestosController@verPresupuesto', $presupuesto->numerohistoria, $presupuesto->id))) }}
        {{ Form::textarea('observaciones', $presupuesto->observaciones) }}
        {{ Form::submit('Modificar', array('class'=>'botonl'))}}
    {{ Form::close() }}
    <br>

    <hr/>
    Acciones:

    {{ HTML::linkAction('PresupuestosController@verpresupuestos', 'Volver a los presupuestos de este paciente', $paciente) }}
    | {{ HTML::linkAction('PresupuestosController@imprimirPresupuesto', 'Imprimible', array($paciente, $presupuesto->id)) }}
    | {{ HTML::linkAction('PresupuestosController@imprimirPDF', 'Descargar PDF', array($paciente, $presupuesto->id)) }}
    | {{ HTML::linkAction('PresupuestosController@verPDF', 'Ver PDF', array($paciente, $presupuesto->id)) }}

	</div>
@stop
