@extends('layouts.main')

@section('title')
    Presupuestos
@stop

@section('contenido')

<div>
    <h1>Presupuestos del paciente:</h1>
    <table border = "1">
	<tr>
	    <td>NHC:
	    </td><td>{{$paciente->numerohistoria}}
	    </td><td>Nombre:
	    </td><td>{{$paciente->nombre}}
	    </td><td>Apellidos:
	    </td><td>{{$paciente->apellido1.' '.$paciente->apellido2}}
	    </td><td>NIF:
	    </td><td>{{$paciente->NIF}}
	    </td><td>{{$paciente->compania}}
	    </td>
	 </tr>
      </table>

</div>
<div>
      {{{ $presupuesto or 'No existen presupuestos para este paciente. ¿Crear uno?' }}}

<table>
  <tr>

    <th>Id:</th>
    <th>Creado:</th>
    <th>Actualizado:</th>
    <th>Nombre</th>
    <th>Importe total</th>
    <th>Desc. total</th>
    <th>Creado por</th>
    <th>Profesiona</th>
    <th>Aceptado</th>

    <th>{{$presupuesto->id}}</th>
    <th>{{$presupuesto->created_at}}</th>
    <th>{{$presupuesto->updated_at}}</th>
    <th>{{$presupuesto->nombre_p}}</th>
    <th>{{$presupuesto->importetotal}}</th>
    <th>{{$presupuesto->descuentototal}}</th>
    <th>{{$presupuesto->creado_por}}</th>
    <th>{{$presupuesto->profesional}}</th>
    <th>{{$presupuesto->aceptado}}</th>
  </tr>
</table>




</div>
@stop
