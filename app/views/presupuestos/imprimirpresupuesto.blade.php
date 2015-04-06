    <h2>Presupuesto: {{ $presupuesto->nombre}}</h2>
    <h3>Paciente: {{ $paciente }}</h3>

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
