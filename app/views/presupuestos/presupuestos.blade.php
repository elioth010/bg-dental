@extends('layouts.main')

@section('title')
    Presupuestos
@stop

@section('contenido')

<div>
    <h1>Presupuestos del paciente:</h1>
    {{--<p>{{$paciente->nombre}}, {{$paciente->apellido1}} {{$paciente->apellido2}}. NHC: {{$paciente->numerohistoria}}</p>--}}
    <table border = "1">
	<tr>
	    <th>NHC:</th>

        <th>Nombre:</th>

	    <th>Apellidos:</th>

        <th>NIF:</th>

        <th>Compañía:</th>

	 </tr>
         <tr>
             <td>{{$paciente->numerohistoria}}</td>
              <td>{{$paciente->nombre}}</td>
              <td>{{$paciente->apellido1.' '.$paciente->apellido2}}</td>
              <td>{{$paciente->NIF}}</td>
              <td>{{ $paciente->companias_text }}</td>
         </tr>
      </table>

</div>
<div>
      </p>
      {{ HTML::linkAction('PresupuestosController@crearpresupuesto', '¿Crear uno nuevo?', $paciente->numerohistoria) }}</p>

<table class="rollwht">
  <tr>

    <th>Id</th>
    <th>Creado</th>
    <th>Actualizado</th>
    <th>Nombre</th>
    <th>Importe total</th>
    <th>Desc. total</th>
    <th>Creado por</th>
    <th>Profesional</th>
    <th>Aceptado</th>
    <th style="width: 130px;">Acciones</th>
  </tr>
  @foreach($presupuestos as $presupuesto)
    <tr>
    <td class="blue">{{ HTML::linkAction('PresupuestosController@verPresupuesto', $presupuesto->id,
                array($paciente->numerohistoria, $presupuesto->id)) }}</td>
    <td>{{$presupuesto->creado}}</td>
    <td>{{$presupuesto->actualizado}}</td>
    <td>{{$presupuesto->nombre}}</td>
    <td>{{number_format($presupuesto->importe_total, 2, ',', '.') }}&nbsp;€</td>
    <td>{{number_format($presupuesto->descuentotota, 2, ',', '.') }}&nbsp;€</td>
    <td>{{$presupuesto->user_n}}</td>
    <td>{{$presupuesto->profesional_n}}</td>
    <td><?php if ($presupuesto->aceptado) echo 'Sí'; else echo 'No'; ?></td>
    <td>{{ HTML::linkAction('PresupuestosController@verPresupuesto', 'Ver',
                array($paciente->numerohistoria, $presupuesto->id), array('class'=>'botonm')) }}
        <?php if (!$presupuesto->aceptado) { ?>
          {{ HTML::linkAction('PresupuestosController@editarPresupuesto', 'Editar',
                array($paciente->numerohistoria, $presupuesto->id), array('class'=>'botonm')) }}
          {{ HTML::linkAction('PresupuestosController@aceptarPresupuesto', 'Aceptar',
                array($paciente->numerohistoria, $presupuesto->id), array('class'=>'botonm')) }}
        <?php } ?>
    </td>
  </tr>
  @endforeach
</table>




</div>
@stop
