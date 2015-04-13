<!DOCTYPE html>
<html lang="en">

  <head>
      <title>Imprimir presupuesto</title>
      <meta charset="utf-8">
      <script src="/js/jquery-1.11.0.min.js"></script>
      <script src="/js/jquery.maphilight.min.js"></script>
      <script src="/js/presupuestos.js"></script>
      <link rel="icon" type="image/png" sizes="16x16" href="/imagenes/favicon.png" />
  </head>

 <body>

    <h2>Presupuesto: {{ $presupuesto->nombre}}</h2>
    <h3>Paciente: {{ $paciente->numerohistoria }}</h3>

    <div id="datos1">
        Nombre: {{ $paciente->nombre }} {{ $paciente->apellido1 }} {{ $paciente->apellido2 }} </br>
        Dirección: {{ $paciente->Direccion }}
        {{ $paciente->addrnamestre }} {{ $paciente->addrpostcode }} </br>
        Teléfono: {{ $paciente->addrtel1 }}, {{ $paciente->addrtel2 }}
    </div>

    @if ($showpdf)
    PDF: {{ HTML::linkAction('PresupuestosController@imprimirPDF', 'Descargar', array($paciente->numerohistoria, $presupuesto->id)) }}
         {{ HTML::linkAction('PresupuestosController@verPDF', 'Ver', array($paciente->numerohistoria, $presupuesto->id)) }}
    @endif

    <table border=1>
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
        <td>{{ $t->estado_text }}</td>
        <td>{{ $t->precio_final }}€</td>
      </tr>
      <?php $i++ ?>
      @endforeach
      <tr>
        <td><strong>TOTAL:</strong></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><strong>{{ $total }}€</strong></td>
      </tr>
    </table>

    </br>

    <div id="dodontograma" style="width: 60%; margin: 0 auto;">
    @include('presupuestos.odontograma')
    @yield('odontograma')
    </div>

    <script type="text/javascript">
        $(document).ready(function() {

            od = $('#dodontograma')
            od.attr({id: "dodontograma-0"})
            od.find('map').attr({name: "odontograma-0", id: "odontograma-0"})
            od.find('img').attr({usemap: "#odontograma-0", id: "iodontograma-0"})

            odontogramaHighlight(0, 0, false)
            odontogramaHighlightPuente(0, "{{ $t->piezas }}", true)
            odontogramaDisableHighlightPuente(0, "{{ $t->piezas }}", true)
        });
    </script>
</body>
</html>
