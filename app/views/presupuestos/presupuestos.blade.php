@extends('layouts.main')

@section('contenido')

<div>
    <h1>Presupuestos del paciente:</h1>
    <table border = "1">
	<tr>
	    <td>NHC:</td>
	    <td>{{$paciente->numerohistoria}}</td>
        <td>Nombre:</td>
        <td>{{$paciente->nombre}}</td>
	    <td>Apellidos:</td>
        <td>{{$paciente->apellido1.' '.$paciente->apellido2}}</td>
        <td>NIF:</td>
	    <td>{{$paciente->NIF}}</td>
        <td>Compañía:</td>
        <td>{{$paciente->compania}}</td>
	 </tr>
      </table>

</div>
<div>
      </p>
      {{ HTML::linkAction('PresupuestosController@crearpresupuesto', '¿Crear uno nuevo?', $paciente->numerohistoria) }}</p>

<table>
  <tr>

    <th>Id:</th>
    <th>Creado:</th>
    <th>Actualizado:</th>
    <th>Nombre</th>
    <th>Importe total</th>
    <th>Desc. total</th>
    <th>Creado por</th>
    <th>Profesional</th>
    <th>Aceptado</th>
    <th>Acciones</th>
  </tr>
  @foreach($presupuestos as $presupuesto)
    <tr>
    <td>{{ HTML::linkAction('PresupuestosController@verPresupuesto', $presupuesto->id,
                array($paciente->numerohistoria, $presupuesto->id)) }}</td>
    <td>{{$presupuesto->created_at}}</td>
    <td>{{$presupuesto->updated_at}}</td>
    <td>{{$presupuesto->nombre}}</td>
    <td>{{ $presupuesto->importe_total }}€</td>
    <td>{{$presupuesto->descuentototal}}</td>
    <td>{{$presupuesto->user_n}}</td>
    <td>{{$presupuesto->profesional_n}}</td>
    <td><?php if ($presupuesto->aceptado) echo 'Sí'; else echo 'No'; ?></td>
    <td>{{ HTML::linkAction('PresupuestosController@verPresupuesto', 'Ver',
                array($paciente->numerohistoria, $presupuesto->id)) }}
        <?php if (!$presupuesto->aceptado) { ?>
        | {{ HTML::linkAction('PresupuestosController@editarPresupuesto', 'Editar',
                array($paciente->numerohistoria, $presupuesto->id)) }}
        | {{ HTML::linkAction('PresupuestosController@aceptarPresupuesto', 'Aceptar',
                array($paciente->numerohistoria, $presupuesto->id)) }}
        <?php } ?>
                </td>
  </tr>
  @endforeach
</table>




</div>
@stop
