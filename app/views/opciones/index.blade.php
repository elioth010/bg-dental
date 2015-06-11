@extends('opciones.crearopciones')

@section('title')
    Opciones
@stop

@section('listado_opciones')
 <h3>
  Opciones:
  </h3>

    <table border = "1">
      <tr>
      <th>Nombre</th>
      <th>Valor</th>
      </tr>

      @foreach($opciones as $opcion)
        <tr>
        <td>{{HTML::linkAction('OpcionesController@edit', $opcion->nombre, $opcion->id)}}</td>
        <td>
            @if($opcion->oculto >0)
            *************
            @else
            {{$opcion->valor}}
            @endif
        </td>
        </tr>
      @endforeach

    </table>
@stop
