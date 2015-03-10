@extends('layouts.main')

@section('contenido')

    <h2>Presupuesto: {{ $presupuesto->nombre}}</h2>

    <p>Tratamientos incluidos:</p>

    <table>
      <tr>
        <th></th>
        <th>Nombre</th>
        <th>Unidades</th>
        <th>Precio unidad</th>
        <th>Descuento €</th>
        <th>Precio final</th>
        <th>Compañía</th>
        <th>Piezas</th>
        <th>Estado</th>
      </tr>
      <?php $i=1 ?>
      @foreach($tratamientos as $t)
        <tr>
        <td>{{ $i }}</td>
        <td>{{ $t->nombre }}</td>
        <td>{{ $t->unidades }}</td>
        <td>{{ $t->precio_unidad }}€</td>
        <td>{{ $t->descuento_text }}</td>
        <td>{{ $t->precio_final }}€</td>
        <td>{{ $t->compania_text }}</td>
        <td>{{ $t->piezas }}</td>
        <td>{{ $t->estado_text }}</td>
      </tr>
      <?php $i++ ?>
      @endforeach
    </table>

    <hr/>
    {{ HTML::linkAction('PresupuestosController@verpresupuestos', 'Volver a los presupuestos de este paciente', $paciente) }}

@stop
