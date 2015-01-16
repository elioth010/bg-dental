@extends('layouts.main')
 
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
      </p>
      {{ HTML::link('pacientes/'.$paciente->numerohistoria.'/crearpresupuesto', '¿Crear uno nuevo?') }}</p>
      
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
  </tr>
  @foreach($presupuestos as $presupuesto)
    <tr>
    <td>{{ HTML::linkAction('PresupuestosController@verPresupuesto', $presupuesto->presupuesto_id,
                array($paciente->numerohistoria, $presupuesto->presupuesto_id)) }}</td>
    <td>{{$presupuesto->creado}}</td>
    <td>{{$presupuesto->modificado}}</td>
    <td>{{$presupuesto->nombre_p}}</td>
    <td>{{$total}}</td>
    <td>{{$presupuesto->descuentototal}}</td>
    <td>{{$presupuesto->nombre_u}}</td>
    <td>{{$presupuesto->profesional}}</td>
    <td>{{$presupuesto->aceptado}}</td>
    <td>{{ HTML::linkAction('PresupuestosController@verPresupuesto', 'Ver',
                array($paciente->numerohistoria, $presupuesto->presupuesto_id)) }} |
                {{ HTML::linkAction('PresupuestosController@editarPresupuesto', 'Editar',
                            array($paciente->numerohistoria, $presupuesto->presupuesto_id)) }}</td>
  </tr>
  @endforeach
</table>




</div>
@stop
