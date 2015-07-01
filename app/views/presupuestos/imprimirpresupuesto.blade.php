<!DOCTYPE html>
<html lang="en">

  <head>
      <title>Imprimir presupuesto nº {{ $presupuesto->id }}</title>
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
	  margin: 3%;
		}
		body {
		font-family: arial, sans-serif;
		font-size: 1em;
		color: #333333;
		line-height: 1.2em;
		}
		.layout{
		margin: auto;
		padding: 15px 30px 0 30px;
		}
		table {
	border-collapse: collapse;
	border-spacing: 0;}
		table.tabla{
		text-align: center;
		width: 100%;}
		table.tabla td, table.tabla th{
		padding:0 3px 0 3px;
		border-right: solid 1px #888;
		border-bottom: 1px solid #888;
		}
		.odontogram{
		display: block;
		}
		table.tabla_01{
		border: 1px solid #888;
		margin: auto;
		}
		h2{
		font-size: 12;
		padding-bottom: 0.3em;
		color: #1271b3;
		}
		h3{
		font-size: 11pt;
		padding-bottom: 0.3em;
		color: #044494;}
		h4{
		font-size: 9pt;
		padding-bottom: 0.3em;
		font-weight: bold;
		text-transform: uppercase;}
		ul{
		line-height: 1.5em;
		padding-bottom: 1.3em;
		}
		.negrita{
		font-weight: bold;}
		.grey{
		background-color: #ededed;}
		#textos li{
		font-size: 9pt;
		text-align: justify;
		padding-left: 20px;
		line-height: 11pt;
		}
		.red{color:red;}
		table.tabla{
		font-size: 9pt;
		}
		.tbl_drc{
		float: left;
		margin-left: 30px;
		text-transform: uppercase;
		margin-top: 0.0cm;
		}
		.tbl_izq{
		float: right;

                margin-top: 20px;
		}
		.datos{
		line-height: 1.2em;
		font-size: 9pt;
		color: #044494;
		margin:auto;
		text-transform: uppercase;
		}
		.header{
		width: 100%;
		height: 4.3cm;}
		.datos1{
		font-size: 10pt;
		}
		.logo{
		width: 5cm;}
		@media print{
		.vista{
		display: none;
		}
		.odontogram{
		margin: auto;
		}
}
	 </style>

  </head>

<body>
	<div class="header">
    <div class="tbl_izq">
       {{--<h3>Presupuesto: {{ $presupuesto->nombre}}</h3>--}}
    <h2>Paciente: {{ $paciente->numerohistoria }}</h2>

    <ul class="datos1">
        <li>Nombre: <span class="negrita">{{ $paciente->nombre }} {{ $paciente->apellido1 }} {{ $paciente->apellido2 }}</span></li>
        <li>Dirección: {{ $paciente->Direccion }}
        {{ $paciente->addrnamestre }} {{ $paciente->addrpostcode }} </li>
        <li>Teléfono: {{ $paciente->addrtel1 }} {{ $paciente->addrtel2 }}</li>
        <li>Dra./Dr. {{$presupuesto->p_a1}} {{$presupuesto->p_a2}}</li>
	<li class="vista">
    @if ($showpdf)
    PDF: {{ HTML::linkAction('PresupuestosController@imprimirPDF', 'Descargar', array($paciente->numerohistoria, $presupuesto->id), ['target'=>'_blank']) }}
         {{ HTML::linkAction('PresupuestosController@verPDF', 'Ver', array($paciente->numerohistoria, $presupuesto->id), ['target'=>'_blank']) }}
    @endif
	</li>
        <li>{{--{{HTML::link('http://www.imiquiron.com', 'Para más información www.imiquiron.com.', ['target'=>'_blank'])}}--}}</li>
	</ul>
	</div>
	<div class="tbl_drc">
     <ul class="datos">
     	<li>{{ HTML::image('/imagenes/quiron-logo.jpg', 'Logo', array('class' => 'logo', 'id' => 'logo')) }}</li>
        <li>{{ $sede->calleynum }}</li>
        <li>{{ $sede->cp }} {{ $sede->ciudad }} ({{ $sede->provincia }})  </li>
        <li>{{ $sede->tel }}</li>
        <li>{{ $sede->mail }}</li>
	</ul>
	</div>
	</div>
    <div id="textos" style="text-align: center; font-size: 8pt;color: #044494;">Para más información sobre su presupuesto o tratamiento visite www.imiquiron.com</div>
	<div class="layout">
    @if ($todaslaspiezas['muestraOdontograma'])
        @if (isset($todaslaspiezas['custom']))
        <div align="center">
            {{ HTML::image('/imagenes/'.$todaslaspiezas['custom'], 'Odontograma personalizado') }}
        </div>
        @else
	<div class="odontogram">
        <table class="tabla_01">
            <tr>
		<td>{{ HTML::image($todaslaspiezas[18], null, array('width' => 21, 'height' => 65)) }}</td>
		<td>{{ HTML::image($todaslaspiezas[17], null, array('width' => 23, 'height' => 65)) }}</td>
		<td>{{ HTML::image($todaslaspiezas[16], null, array('width' => 24, 'height' => 65)) }}</td>
		<td>{{ HTML::image($todaslaspiezas[15], null, array('width' => 22, 'height' => 65)) }}</td>
		<td>{{ HTML::image($todaslaspiezas[14], null, array('width' => 24, 'height' => 65)) }}</td>
		<td>{{ HTML::image($todaslaspiezas[13], null, array('width' => 22, 'height' => 65)) }}</td>
		<td>{{ HTML::image($todaslaspiezas[12], null, array('width' => 22, 'height' => 65)) }}</td>
		<td>{{ HTML::image($todaslaspiezas[11], null, array('width' => 23, 'height' => 65)) }}</td>
		<td>{{ HTML::image($todaslaspiezas[21], null, array('width' => 23, 'height' => 65)) }}</td>
		<td>{{ HTML::image($todaslaspiezas[22], null, array('width' => 22, 'height' => 65)) }}</td>
		<td>{{ HTML::image($todaslaspiezas[23], null, array('width' => 22, 'height' => 65)) }}</td>
		<td>{{ HTML::image($todaslaspiezas[24], null, array('width' => 22, 'height' => 65)) }}</td>
		<td>{{ HTML::image($todaslaspiezas[25], null, array('width' => 22, 'height' => 65)) }}</td>
		<td>{{ HTML::image($todaslaspiezas[26], null, array('width' => 25, 'height' => 65)) }}</td>
		<td>{{ HTML::image($todaslaspiezas[27], null, array('width' => 23, 'height' => 65)) }}</td>
		<td>{{ HTML::image($todaslaspiezas[28], null, array('width' => 19, 'height' => 65)) }}</td>
            </tr>
            <tr>
		<td>{{ HTML::image($todaslaspiezas[48], null, array('width' => 21, 'height' => 65)) }}</td>
		<td>{{ HTML::image($todaslaspiezas[47], null, array('width' => 23, 'height' => 65)) }}</td>
		<td>{{ HTML::image($todaslaspiezas[46], null, array('width' => 24, 'height' => 65)) }}</td>
		<td>{{ HTML::image($todaslaspiezas[45], null, array('width' => 22, 'height' => 65)) }}</td>
		<td>{{ HTML::image($todaslaspiezas[44], null, array('width' => 24, 'height' => 65)) }}</td>
		<td>{{ HTML::image($todaslaspiezas[43], null, array('width' => 22, 'height' => 65)) }}</td>
		<td>{{ HTML::image($todaslaspiezas[42], null, array('width' => 22, 'height' => 65)) }}</td>
		<td>{{ HTML::image($todaslaspiezas[41], null, array('width' => 23, 'height' => 65)) }}</td>
		<td>{{ HTML::image($todaslaspiezas[31], null, array('width' => 23, 'height' => 65)) }}</td>
		<td>{{ HTML::image($todaslaspiezas[32], null, array('width' => 22, 'height' => 65)) }}</td>
		<td>{{ HTML::image($todaslaspiezas[33], null, array('width' => 22, 'height' => 65)) }}</td>
		<td>{{ HTML::image($todaslaspiezas[34], null, array('width' => 22, 'height' => 65)) }}</td>
		<td>{{ HTML::image($todaslaspiezas[35], null, array('width' => 22, 'height' => 65)) }}</td>
		<td>{{ HTML::image($todaslaspiezas[36], null, array('width' => 25, 'height' => 65)) }}</td>
		<td>{{ HTML::image($todaslaspiezas[37], null, array('width' => 23, 'height' => 65)) }}</td>
		<td>{{ HTML::image($todaslaspiezas[38], null, array('width' => 19, 'height' => 65)) }}</td>
		</tr>
        </table>
        </div>
        @endif
    @endif

  	</br>
    <div class="datos1">Fecha de emisión: {{ $presupuesto->creado }}</div>
    <div>
    <table class="tabla">
      <tr class="grey">
        <th></th>
        <th>Tratamiento</th>
        <th>Piezas</th>
        <th>Ud.</th>
        <th>€ ud.</th>
        <th>Desc.</th>
        <th>Precio final</th>
        <th>Compañía</th>
      </tr>
      <?php $i=1 ?>
      @foreach($tratamientos as $t)
      <tr style="font-size:9pt;">
        <td>{{ $i }}</td>
        <td>{{ $t->nombre }}</td>
        <td> @if ($t->tipostratamientos_id == 4) Cuadrante @endif {{ $t->piezas }}</td>
        <td>{{ $t->unidades }}</td>
        <?php $grupos_q = array(158, 159, 160, 161, 162, 163, 164);
                        ?>
        <td>@if($t->precio_unidad > 0 && !in_array($t->id, $grupos_q))
            {{  number_format($t->precio_unidad, 2, ',', '.') }}€
            @endif
        </td>
        <td>{{ $t->descuento_text }}</td>
        <td>@if($t->precio_final > 0 && in_array($t->id, $grupos_q))
            {{  number_format($t->precio_final, 2, ',', '.') }}€
            @endif
            
        </td>
        <td>{{ $t->compania_text }}</td>
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
        <td><strong>{{  number_format($total,2, ',', '.') }}€</strong></td>
      </tr>
    </table>
	</div>
    </br>
  	<div id="textos">
            <h4>Observaciones: {{$presupuesto->observaciones_p}}</h4>
            <h3>Este presupuesto tiene una validez de {{$validez->valor}} meses.</h3>
     <h4>Condiciones de pago:</h4>
     <ul>
    <li>• El día citado para el ingreso en el Hospital, se abonará o se presentará el justificante de pago del total del presupuesto en el servicio de Admisión en concepto de depósito.</li>
    <li>• El pago puede ser en efectivo, mediante talón, tarjeta de crédito o ingresando la totalidad del importe señalado en nuestra cuenta bancaria a nombre de Grupo Hospitalaria Quirón, S.A. (Indicar en concepto el nombre del paciente):</br>
        <span style="padding-left:60px; font-weight:bold;">Nº CUENTA BANCARIA:   <span class="red"> {{ $sede->cuenta }}</span></li>
    <li>• Al alta, el Hospital emitirá la factura por los gastos ocasionados durante su estancia, que se abonará en ese mismo momento.</li>
    </ul>
        <h4>Condiciones de financiación:</h4>
        <ul>
            <li>• En caso de que desee financiar este presupuesto rogamos se ponga en contacto previamente a la intervención con nosotros para tramitar la financiación. </li>
 		</ul>
 	</div>
        <p style="font-size:7pt;text-align: justify;line-height: 9pt;">
            El importe del presupuesto es meramente orientativo, ya que ha sido elaborado teniendo en cuenta los servicios habituales que se producen en este tipo de tratamiento. Por tanto, atendiendo a las características propias y al estado de salud del paciente, al curso del tratamiento y/o a las decisiones que puedan tomar los facultativos que atiendan al paciente, es probable que la cantidad final a facturar sufra cambios. Estas modificaciones vendrán determinadas en función de, entre otros conceptos, los días de estancia, la prescripción de terapéuticas y pruebas diagnósticas y los consumos de fármacos y materiales que efectivamente se hayan devengado durante el tratamiento.
Sus datos personales serán incorporados a un fichero responsabilidad de Grupo Hospitalario Quirón, S.A. (en adelante, GHQ) con la finalidad de gestionar los servicios sanitarios y de administración del hospital. En el caso de que los servicios recibidos deban ser abonados por una mutua, aseguradora, Administración Pública u otra persona física o jurídica, sus datos podrán ser cedidos a dichos terceros con la finalidad de gestionar la facturación de nuestros servicios; si se opone a la cesión, estas entidades podrían rehusar el pago de los servicios recibidos, correspondiéndole a usted su abono. Podrá ejercer los derechos de acceso, rectificación, cancelación y oposición ante GHQ, a través de correo postal dirigido a: Grupo Hospitalario Quirón, S.A. “Derechos ARCO” - Paseo Mariano Renovales s/n, 50006 Zaragoza, aportando fotocopia de su DNI o documento equivalente, y concretando el derecho que desea ejercer.

        </p>


</body>
</html>
