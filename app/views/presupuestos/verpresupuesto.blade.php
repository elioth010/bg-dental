@extends('layouts.main')

@section('contenido')

    <h2>Presupuesto: {{ $presupuesto->nombre}}</h2>

    <p>Tratamientos incluidos:</p>

    <table>
      <tr>
        <th></th>
        <th>Nombre</th>
        <th>Unidades</th>
        <th>Descuento €</th>
        <th>Descuento %</th>
        <th>Pieza 1</th>
        <th>Pieza 2</th>
        <th>Pieza 3</th>
        <th>Estado</th>
      </tr>
      <?php $i=1 ?>
      @foreach($tratamientos as $t)
        <tr>
        <td>{{ $i }}</td>
        <td>{{ $t->nombre }}</td>
        <td>{{ $t->unidades }}</td>
        <td>{{ $t->desc_euros }}</td>
        <td>{{ $t->desc_porcien }}</td>
        <td>{{ $t->pieza1 }}</td>
        <td>{{ $t->pieza2 }}</td>
        <td>{{ $t->pieza3 }}</td>
        <td>{{ $t->estado }}</td>
      </tr>
      <?php $i++ ?>
      @endforeach
    </table>

    <hr/>
    {{ HTML::linkAction('PresupuestosController@verpresupuestos', 'Volver a los presupuestos de este paciente', $paciente) }}

@stop
