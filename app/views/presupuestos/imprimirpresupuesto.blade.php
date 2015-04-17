<!DOCTYPE html>
<html lang="en">

  <head>
      <title>Imprimir presupuesto</title>
      <meta charset="utf-8">
      <style type="text/css">
      html, body, div, span, applet, object, iframe,
h1, h2, h3, h4, h5, h6, p, blockquote, pre,
a, abbr, acronym, address, big, cite, code,
del, dfn, em, img, ins, kbd, q, s, samp,
small, strike, strong, sub, sup, tt, var,
b, u, i, center,
dl, dt, dd, ol, ul, li,
fieldset, form, label, legend,
table, caption, tbody, tfoot, thead, tr, th, td,
article, aside, canvas, details, embed, 
figure, figcaption, footer, header, hgroup, 
menu, nav, output, ruby, section, summary,
time, mark, audio, video {
	margin: 0;
	padding: 0;
	border: 0;
	font-size: 100%;
	font: inherit;
	vertical-align: baseline;
}
/* HTML5 display-role reset for older browsers */
article, aside, details, figcaption, figure, 
footer, header, hgroup, menu, nav, section {
	display: block;
}
ol, ul {
	list-style: none;
}
blockquote, q {
	quotes: none;
}
blockquote:before, blockquote:after,
q:before, q:after {
	content: '';
	content: none;
}

      @page {
	  size: A4;/* es el valor por defecto */
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
		table {
	border-collapse: collapse;
	border-spacing: 0;}
		table.tabla{
		text-align: center;}
		table.tabla td, table.tabla th{
		padding:0 3px 0 3px;
		border-right: solid 1px #888;
		border-bottom: 1px solid #888;
		}
		.odontogram{
		margin-left: 10%;
		display: block;
		}
		table.tabla_01{
		width: 449px;
		}
		h2{
		font-size: 12;
		padding-bottom: 0.3em;
		color: #1271b3;
		}
		h3{
		font-size: 11pt;
		padding-bottom: 0.3em;
		color: #025494;}
		ul{
		line-height: 1.5em;
		padding-bottom: 1.3em;
		}
		.negrita{
		font-weight: bold;}
		.grey{
		background-color: #ededed;}
		@media print{
		.vista{
		display: none;
		}
		table.tabla{
		font-size: 9pt;}
		}
		.logo{
		width: 8cm;}
		.tbl_izq{
		float: left;
		margin-right: 100px;
		}
		.datos{
		line-height: 1.2em;
		font-size: 0.8em;
		color: #025494;
		margin-top: 0.8cm;
		float: left;
		}
		.header{
		width: 100%;
		height: 3cm;}
		.layout{
		margin-top: 1cm;}
		.datos1{
		font-size: 10pt;}
		}
	 </style>

  </head>

<body>
	<div class="header">
    <div class="tbl_izq">
        {{ HTML::image('/imagenes/quiron-logo.jpg', 'Logo', array('class' => 'logo', 'id' => 'logo')) }}
    </div>
    <ul class="datos">
        <li>{{ $sede->calleynum }}</li>
        <li>{{ $sede->cp }} {{ $sede->ciudad }}</li>
        <li>{{ $sede->provincia }}</li>
        <li>{{ $sede->tel }}</li>
        <li>{{ $sede->mail }}</li>
	</ul>
	</div>
	<div class="layout">
    <h3>Presupuesto: {{ $presupuesto->nombre}}</h3>
    <h2>Paciente: {{ $paciente->numerohistoria }}</h2>

    <ul class="datos1">
        <li>Nombre: <span class="negrita">{{ $paciente->nombre }} {{ $paciente->apellido1 }} {{ $paciente->apellido2 }}</span></li>
        <li>Dirección: {{ $paciente->Direccion }}
        {{ $paciente->addrnamestre }} {{ $paciente->addrpostcode }} </li>
        <li>Teléfono: {{ $paciente->addrtel1 }}, {{ $paciente->addrtel2 }}</li>
	<li class="vista">
    @if ($showpdf)
    PDF: {{ HTML::linkAction('PresupuestosController@imprimirPDF', 'Descargar', array($paciente->numerohistoria, $presupuesto->id)) }}
         {{ HTML::linkAction('PresupuestosController@verPDF', 'Ver', array($paciente->numerohistoria, $presupuesto->id)) }}
    @endif
	</li>
	</ul>
    <div>
    <table class="tabla">
      <tr class="grey">
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
      <tr class="grey">
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
	<div class="odontogram">
    <table class="tabla_01">
        <tr>
            <td>
                <img src="http://{{ $HTTP_HOST }}/imagenes/18{{ $todaslaspiezas[18] }}.jpg" width="33" height="176" alt=""></td>
            <td>
                <img src="http://{{ $HTTP_HOST }}/imagenes/17{{ $todaslaspiezas[17] }}.jpg" width="34" height="176" alt=""></td>
            <td>
                <img src="http://{{ $HTTP_HOST }}/imagenes/16{{ $todaslaspiezas[16] }}.jpg" width="33" height="176" alt=""></td>
            <td>
                <img src="http://{{ $HTTP_HOST }}/imagenes/15{{ $todaslaspiezas[15] }}.jpg" width="25" height="176" alt=""></td>
            <td>
                <img src="http://{{ $HTTP_HOST }}/imagenes/14{{ $todaslaspiezas[14] }}.jpg" width="25" height="176" alt=""></td>
            <td>
                <img src="http://{{ $HTTP_HOST }}/imagenes/13{{ $todaslaspiezas[13] }}.jpg" width="25" height="176" alt=""></td>
            <td>
                <img src="http://{{ $HTTP_HOST }}/imagenes/12{{ $todaslaspiezas[12] }}.jpg" width="25" height="176" alt=""></td>
            <td>
                <img src="http://{{ $HTTP_HOST }}/imagenes/11{{ $todaslaspiezas[11] }}.jpg" width="25" height="176" alt=""></td>
            <td>
                <img src="http://{{ $HTTP_HOST }}/imagenes/21{{ $todaslaspiezas[21] }}.jpg" width="25" height="176" alt=""></td>
            <td>
                <img src="http://{{ $HTTP_HOST }}/imagenes/22{{ $todaslaspiezas[22] }}.jpg" width="25" height="176" alt=""></td>
            <td>
                <img src="http://{{ $HTTP_HOST }}/imagenes/23{{ $todaslaspiezas[23] }}.jpg" width="25" height="176" alt=""></td>
            <td>
                <img src="http://{{ $HTTP_HOST }}/imagenes/24{{ $todaslaspiezas[24] }}.jpg" width="25" height="176" alt=""></td>
            <td>
                <img src="http://{{ $HTTP_HOST }}/imagenes/25{{ $todaslaspiezas[25] }}.jpg" width="25" height="176" alt=""></td>
            <td>
                <img src="http://{{ $HTTP_HOST }}/imagenes/26{{ $todaslaspiezas[26] }}.jpg" width="33" height="176" alt=""></td>
            <td>
                <img src="http://{{ $HTTP_HOST }}/imagenes/27{{ $todaslaspiezas[27] }}.jpg" width="33" height="176" alt=""></td>
            <td>
                <img src="http://{{ $HTTP_HOST }}/imagenes/28{{ $todaslaspiezas[28] }}.jpg" width="33" height="176" alt=""></td>
        </tr>
        <tr>
            <td>
                <img src="http://{{ $HTTP_HOST }}/imagenes/48{{ $todaslaspiezas[48] }}.jpg" width="33" height="170" alt=""></td>
            <td>
                <img src="http://{{ $HTTP_HOST }}/imagenes/47{{ $todaslaspiezas[47] }}.jpg" width="34" height="170" alt=""></td>
            <td>
                <img src="http://{{ $HTTP_HOST }}/imagenes/46{{ $todaslaspiezas[46] }}.jpg" width="33" height="170" alt=""></td>
            <td>
                <img src="http://{{ $HTTP_HOST }}/imagenes/45{{ $todaslaspiezas[45] }}.jpg" width="25" height="170" alt=""></td>
            <td>
                <img src="http://{{ $HTTP_HOST }}/imagenes/44{{ $todaslaspiezas[44] }}.jpg" width="25" height="170" alt=""></td>
            <td>
                <img src="http://{{ $HTTP_HOST }}/imagenes/43{{ $todaslaspiezas[43] }}.jpg" width="25" height="170" alt=""></td>
            <td>
                <img src="http://{{ $HTTP_HOST }}/imagenes/42{{ $todaslaspiezas[42] }}.jpg" width="25" height="170" alt=""></td>
            <td>
                <img src="http://{{ $HTTP_HOST }}/imagenes/41{{ $todaslaspiezas[41] }}.jpg" width="25" height="170" alt=""></td>
            <td>
                <img src="http://{{ $HTTP_HOST }}/imagenes/31{{ $todaslaspiezas[31] }}.jpg" width="25" height="170" alt=""></td>
            <td>
                <img src="http://{{ $HTTP_HOST }}/imagenes/32{{ $todaslaspiezas[32] }}.jpg" width="25" height="170" alt=""></td>
            <td>
                <img src="http://{{ $HTTP_HOST }}/imagenes/33{{ $todaslaspiezas[33] }}.jpg" width="25" height="170" alt=""></td>
            <td>
                <img src="http://{{ $HTTP_HOST }}/imagenes/34{{ $todaslaspiezas[34] }}.jpg" width="25" height="170" alt=""></td>
            <td>
                <img src="http://{{ $HTTP_HOST }}/imagenes/35{{ $todaslaspiezas[35] }}.jpg" width="25" height="170" alt=""></td>
            <td>
                <img src="http://{{ $HTTP_HOST }}/imagenes/36{{ $todaslaspiezas[36] }}.jpg" width="33" height="170" alt=""></td>
            <td>
                <img src="http://{{ $HTTP_HOST }}/imagenes/37{{ $todaslaspiezas[37] }}.jpg" width="33" height="170" alt=""></td>
            <td>
                <img src="http://{{ $HTTP_HOST }}/imagenes/38{{ $todaslaspiezas[38] }}.jpg" width="33" height="170" alt=""></td>
        </tr>
    </table>
    </div>
</body>
</html>
