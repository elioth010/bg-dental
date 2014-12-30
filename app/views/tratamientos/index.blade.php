@extends('layouts.main')
 
@section('contenido')

  {{ HTML::link('/tratamientos/buscar', 'Buscar tratamientos')}}<p>
  <h1>
  Tratamientos
  </h1>
  <table>
      <tr>
          <th>Código</th>
          <th>Nombre tratamiento</th>
          <th>Precio base</th>
            @foreach($companias as $c)
              <th>{{$c->nombre}}</th>
          @endforeach
      </tr>
      @foreach($tratamientos as $t)
          <tr>

          <td>{{$t->codigo}}</td>
          <td>{{ HTML::link('/tratamientos/editar/'.$t->id, $t->nombre)}}</td>
          <td>{{$t->precio_base.'€'}}</td>
          <?php $precios = explode(',', $t->precios); ?>
          @foreach($precios as $p)
          <td>{{ $p }}</td>
          @endforeach
          </tr>
      @endforeach

  </table>

@stop
