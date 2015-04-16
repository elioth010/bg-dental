<!DOCTYPE html>
<html lang="en">

  <head>
      <title>Imprimir presupuesto</title>
      <meta charset="utf-8">
      <style type="text/css">
      @page {
	  size: auto;/* es el valor por defecto */
	  margin: 10%;
		}
		body {
		font-family: arial, sans-serif;
		font-size: 1em;
		color: #333333;
		line-height: 1.2em;
		}
		.layout{
		margin: auto;
		}
		table{
		text-align: center;}
		table td, table th{
		border-right: solid 1px #888;
		border-bottom: 1px solid #888;
		}

	 </style>

  </head>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

	<div class="layout">
    <h2>Presupuesto: {{ $presupuesto->nombre}}</h2>
    <h3>Paciente: {{ $paciente->numerohistoria }}</h3>

    <div id="datos1">
        <p>Nombre: {{ $paciente->nombre }} {{ $paciente->apellido1 }} {{ $paciente->apellido2 }}</p>
        <p>Dirección: {{ $paciente->Direccion }}
        {{ $paciente->addrnamestre }} {{ $paciente->addrpostcode }} </p>
        <p>Teléfono: {{ $paciente->addrtel1 }}, {{ $paciente->addrtel2 }}</p>
    </div>
	<p>
    @if ($showpdf)
    PDF: {{ HTML::linkAction('PresupuestosController@imprimirPDF', 'Descargar', array($paciente->numerohistoria, $presupuesto->id)) }}
         {{ HTML::linkAction('PresupuestosController@verPDF', 'Ver', array($paciente->numerohistoria, $presupuesto->id)) }}
    @endif
	</p>
    <div class="tabla">
    <table>
      <tr style="background-color:#ededed;">
        <th></th>
        <th>Nombre</th>
        <th>Unidades</th>
        <th>Precio unidad</th>
        <th>Descuento €</th>
        <th>Compañía</th>
        <th>Piezas</th>
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
        <td>{{ $t->precio_final }}€</td>
      </tr>
      <?php $i++ ?>
      @endforeach
      <tr style="background-color:#ededed;">
        <td><strong>TOTAL:</strong></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><strong>{{ $total }}€</strong></td>
      </tr>
    </table>
	</div>
    </br>

    <table id="Tabla_01" width="750" height="577" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td>
                <img src="http://{{ $HTTP_HOST }}/imagenes/odontogramab_01.jpg" width="55" height="294" alt=""></td>
            <td>
                <img src="http://{{ $HTTP_HOST }}/imagenes/odontogramab_02.jpg" width="57" height="294" alt=""></td>
            <td>
                <img src="http://{{ $HTTP_HOST }}/imagenes/odontogramab_03.jpg" width="55" height="294" alt=""></td>
            <td>
                <img src="http://{{ $HTTP_HOST }}/imagenes/odontogramab_04.jpg" width="42" height="294" alt=""></td>
            <td>
                <img src="http://{{ $HTTP_HOST }}/imagenes/odontogramab_05.jpg" width="41" height="294" alt=""></td>
            <td>
                <img src="http://{{ $HTTP_HOST }}/imagenes/odontogramab_06.jpg" width="42" height="294" alt=""></td>
            <td>
                <img src="http://{{ $HTTP_HOST }}/imagenes/odontogramab_07.jpg" width="42" height="294" alt=""></td>
            <td>
                <img src="http://{{ $HTTP_HOST }}/imagenes/odontogramab_08.jpg" width="41" height="294" alt=""></td>
            <td>
                <img src="http://{{ $HTTP_HOST }}/imagenes/odontogramab_09.jpg" width="41" height="294" alt=""></td>
            <td>
                <img src="http://{{ $HTTP_HOST }}/imagenes/odontogramab_10.jpg" width="43" height="294" alt=""></td>
            <td>
                <img src="http://{{ $HTTP_HOST }}/imagenes/odontogramab_11.jpg" width="41" height="294" alt=""></td>
            <td>
                <img src="http://{{ $HTTP_HOST }}/imagenes/odontogramab_12.jpg" width="42" height="294" alt=""></td>
            <td>
                <img src="http://{{ $HTTP_HOST }}/imagenes/odontogramab_13.jpg" width="42" height="294" alt=""></td>
            <td>
                <img src="http://{{ $HTTP_HOST }}/imagenes/odontogramab_14.jpg" width="55" height="294" alt=""></td>
            <td>
                <img src="http://{{ $HTTP_HOST }}/imagenes/odontogramab_15.jpg" width="56" height="294" alt=""></td>
            <td>
                <img src="http://{{ $HTTP_HOST }}/imagenes/odontogramab_16.jpg" width="55" height="294" alt=""></td>
        </tr>
        <tr>
            <td>
                <img src="http://{{ $HTTP_HOST }}/imagenes/odontogramab_17.jpg" width="55" height="283" alt=""></td>
            <td>
                <img src="http://{{ $HTTP_HOST }}/imagenes/odontogramab_18.jpg" width="57" height="283" alt=""></td>
            <td>
                <img src="http://{{ $HTTP_HOST }}/imagenes/odontogramab_19.jpg" width="55" height="283" alt=""></td>
            <td>
                <img src="http://{{ $HTTP_HOST }}/imagenes/odontogramab_20.jpg" width="42" height="283" alt=""></td>
            <td>
                <img src="http://{{ $HTTP_HOST }}/imagenes/odontogramab_21.jpg" width="41" height="283" alt=""></td>
            <td>
                <img src="http://{{ $HTTP_HOST }}/imagenes/odontogramab_22.jpg" width="42" height="283" alt=""></td>
            <td>
                <img src="http://{{ $HTTP_HOST }}/imagenes/odontogramab_23.jpg" width="42" height="283" alt=""></td>
            <td>
                <img src="http://{{ $HTTP_HOST }}/imagenes/odontogramab_24.jpg" width="41" height="283" alt=""></td>
            <td>
                <img src="http://{{ $HTTP_HOST }}/imagenes/odontogramab_25.jpg" width="41" height="283" alt=""></td>
            <td>
                <img src="http://{{ $HTTP_HOST }}/imagenes/odontogramab_26.jpg" width="43" height="283" alt=""></td>
            <td>
                <img src="http://{{ $HTTP_HOST }}/imagenes/odontogramab_27.jpg" width="41" height="283" alt=""></td>
            <td>
                <img src="http://{{ $HTTP_HOST }}/imagenes/odontogramab_28.jpg" width="42" height="283" alt=""></td>
            <td>
                <img src="http://{{ $HTTP_HOST }}/imagenes/odontogramab_29.jpg" width="42" height="283" alt=""></td>
            <td>
                <img src="http://{{ $HTTP_HOST }}/imagenes/odontogramab_30.jpg" width="55" height="283" alt=""></td>
            <td>
                <img src="http://{{ $HTTP_HOST }}/imagenes/odontogramab_31.jpg" width="56" height="283" alt=""></td>
            <td>
                <img src="http://{{ $HTTP_HOST }}/imagenes/odontogramab_32.jpg" width="55" height="283" alt=""></td>
        </tr>
    </table>
</body>
</html>
