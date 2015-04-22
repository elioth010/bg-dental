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
		text-align: center;
		width: 100%;}
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
		h4{
		font-size: 10pt;
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
		font-size: 10pt;
		text-align: justify;
		padding-left: 20px;
		line-height: 12pt;
		}
		.red{color:red;}
		ul.b {list-style-type: disc;}
		table.tabla{
		font-size: 9pt;
		}
		.tbl_izq{
		float: left;
		margin-right: 100px;
		}
		.datos{
		line-height: 1.2em;
		font-size: 10pt;
		color: #025494;
		margin-top: 0.8cm;
		float: left;
		margin-left: 100px;
		}
		.header{
		width: 100%;
		height: 3cm;}
		.layout{
		margin-top: 1cm;}
		.datos1{
		font-size: 10pt;
		}
		.logo{
		width: 8cm;
		float: left;}
		@media print{
		.vista{
		display: none;
		}}
	 </style>

  </head>

<body>
	<div class="header">
    <div class="tbl_izq">
        {{ HTML::image('/imagenes/quiron-logo.jpg', 'Logo', array('class' => 'logo', 'id' => 'logo')) }}
    <ul class="datos">
        <li>{{ $sede->calleynum }}</li>
        <li>{{ $sede->cp }} {{ $sede->ciudad }}</li>
        <li>{{ $sede->provincia }}</li>
        <li>{{ $sede->tel }}</li>
        <li>{{ $sede->mail }}</li>
	</ul>
	    </div>
	</div>
	<div class="layout">
    <h3>Presupuesto: {{ $presupuesto->nombre}}</h3>
    <h2>Paciente: {{ $paciente->numerohistoria }}</h2>

    <ul class="datos1">
        <li>Nombre: <span class="negrita">{{ $paciente->nombre }} {{ $paciente->apellido1 }} {{ $paciente->apellido2 }}</span></li>
        <li>Dirección: {{ $paciente->Direccion }}
        {{ $paciente->addrnamestre }} {{ $paciente->addrpostcode }} </li>
        <li>Teléfono: {{ $paciente->addrtel1 }} {{ $paciente->addrtel2 }}</li>
	<li class="vista">
    @if ($showpdf)
    PDF: {{ HTML::linkAction('PresupuestosController@imprimirPDF', 'Descargar', array($paciente->numerohistoria, $presupuesto->id), ['target'=>'_blank']) }}
         {{ HTML::linkAction('PresupuestosController@verPDF', 'Ver', array($paciente->numerohistoria, $presupuesto->id), ['target'=>'_blank']) }}
    @endif
	</li>
	</ul>
    
    
	<div class="odontogram">
    <table class="tabla_01">
        <tr>
		<td>{{ HTML::image($todaslaspiezas[18], null, array('width' => 33, 'height' => 176)) }}</td>
		<td>{{ HTML::image($todaslaspiezas[17], null, array('width' => 34, 'height' => 176)) }}</td>
		<td>{{ HTML::image($todaslaspiezas[16], null, array('width' => 33, 'height' => 176)) }}</td>
		<td>{{ HTML::image($todaslaspiezas[15], null, array('width' => 25, 'height' => 176)) }}</td>
		<td>{{ HTML::image($todaslaspiezas[14], null, array('width' => 25, 'height' => 176)) }}</td>
		<td>{{ HTML::image($todaslaspiezas[13], null, array('width' => 25, 'height' => 176)) }}</td>
		<td>{{ HTML::image($todaslaspiezas[12], null, array('width' => 25, 'height' => 176)) }}</td>
		<td>{{ HTML::image($todaslaspiezas[11], null, array('width' => 25, 'height' => 176)) }}</td>
		<td>{{ HTML::image($todaslaspiezas[21], null, array('width' => 25, 'height' => 176)) }}</td>
		<td>{{ HTML::image($todaslaspiezas[22], null, array('width' => 25, 'height' => 176)) }}</td>
		<td>{{ HTML::image($todaslaspiezas[23], null, array('width' => 25, 'height' => 176)) }}</td>
		<td>{{ HTML::image($todaslaspiezas[24], null, array('width' => 25, 'height' => 176)) }}</td>
		<td>{{ HTML::image($todaslaspiezas[25], null, array('width' => 25, 'height' => 176)) }}</td>
		<td>{{ HTML::image($todaslaspiezas[26], null, array('width' => 33, 'height' => 176)) }}</td>
		<td>{{ HTML::image($todaslaspiezas[27], null, array('width' => 33, 'height' => 176)) }}</td>
		<td>{{ HTML::image($todaslaspiezas[28], null, array('width' => 33, 'height' => 176)) }}</td>
        </tr>
        <tr>
		<td>{{ HTML::image($todaslaspiezas[48], null, array('width' => 33, 'height' => 170)) }}</td>
		<td>{{ HTML::image($todaslaspiezas[47], null, array('width' => 34, 'height' => 170)) }}</td>
		<td>{{ HTML::image($todaslaspiezas[46], null, array('width' => 33, 'height' => 170)) }}</td>
		<td>{{ HTML::image($todaslaspiezas[45], null, array('width' => 25, 'height' => 170)) }}</td>
		<td>{{ HTML::image($todaslaspiezas[44], null, array('width' => 25, 'height' => 170)) }}</td>
		<td>{{ HTML::image($todaslaspiezas[43], null, array('width' => 25, 'height' => 170)) }}</td>
		<td>{{ HTML::image($todaslaspiezas[42], null, array('width' => 25, 'height' => 170)) }}</td>
		<td>{{ HTML::image($todaslaspiezas[41], null, array('width' => 25, 'height' => 170)) }}</td>
		<td>{{ HTML::image($todaslaspiezas[31], null, array('width' => 25, 'height' => 170)) }}</td>
		<td>{{ HTML::image($todaslaspiezas[32], null, array('width' => 25, 'height' => 170)) }}</td>
		<td>{{ HTML::image($todaslaspiezas[33], null, array('width' => 25, 'height' => 170)) }}</td>
		<td>{{ HTML::image($todaslaspiezas[34], null, array('width' => 25, 'height' => 170)) }}</td>
		<td>{{ HTML::image($todaslaspiezas[35], null, array('width' => 25, 'height' => 170)) }}</td>
		<td>{{ HTML::image($todaslaspiezas[36], null, array('width' => 33, 'height' => 170)) }}</td>
		<td>{{ HTML::image($todaslaspiezas[37], null, array('width' => 33, 'height' => 170)) }}</td>
		<td>{{ HTML::image($todaslaspiezas[38], null, array('width' => 33, 'height' => 170)) }}</td>        
		</tr>
    </table>
    </div>
  	</br>
    
    <div>
    <table class="tabla">
      <tr class="grey">
        <th></th>
        <th>Nombre</th>
        <th>Ud.</th>
        <th>€ ud.</th>
        <th>Desc.</th>
        <th>Compañía</th>
        <th>Piezas</th>
        <th>Precio final</th>
      </tr>
      <?php $i=1 ?>
      @foreach($tratamientos as $t)
      <tr style="font-size:9pt;">
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
  	<div id="textos">
     <h4>Condiciones de pago:</h4>
     <ul class="b">
    <li>• El día citado para el ingreso en el Hospital, se abonará o se presentará el justificante de pago del total del presupuesto en el servicio de Admisión en concepto de depósito.</li>
    <li>• El pago puede ser en efectivo, mediante talón, tarjeta de crédito o ingresando la totalidad del importe señalado en nuestra cuenta bancaria a nombre de Grupo Hospitalaria Quirón, S.A. (Indicar en concepto el nombre del paciente):</li>
        <li style="padding-left:60px; font-weight:bold;">Nº CUENTA BANCARIA:   <span class="red"> {{ $sede->cuenta }}</span></li>
    <li>• Al alta, el Hospital emitirá la factura por los gastos ocasionados durante su estancia, que se abonará en ese mismo momento.</li></br>
    </ul>
        <h4>Condiciones de financiación:</h4>
        <ul class="b">
            <li>• En caso de que desee financiar este presupuesto rogamos se ponga en contacto previamente a la intervención con nosotros para tramitar la financiación. </li>
 		</ul>
 	</div>
 	</br>       
        <p style="font-size:7pt;text-align: justify;line-height: 9pt;">
            El importe del presupuesto es meramente orientativo, ya que ha sido elaborado teniendo en cuenta los servicios habituales que se producen en este tipo de tratamiento. Por tanto, atendiendo a las características propias y al estado de salud del paciente, al curso del tratamiento y/o a las decisiones que puedan tomar los facultativos que atiendan al paciente, es probable que la cantidad final a facturar sufra cambios. Estas modificaciones vendrán determinadas en función de, entre otros conceptos, los días de estancia, la prescripción de terapéuticas y pruebas diagnósticas y los consumos de fármacos y materiales que efectivamente se hayan devengado durante el tratamiento.
Sus datos personales serán incorporados a un fichero responsabilidad de Grupo Hospitalario Quirón, S.A. (en adelante, GHQ) con la finalidad de gestionar los servicios sanitarios y de administración del hospital. En el caso de que los servicios recibidos deban ser abonados por una mutua, aseguradora, Administración Pública u otra persona física o jurídica, sus datos podrán ser cedidos a dichos terceros con la finalidad de gestionar la facturación de nuestros servicios; si se opone a la cesión, estas entidades podrían rehusar el pago de los servicios recibidos, correspondiéndole a usted su abono. Podrá ejercer los derechos de acceso, rectificación, cancelación y oposición ante GHQ, a través de correo postal dirigido a: Grupo Hospitalario Quirón, S.A. “Derechos ARCO” - Paseo Mariano Renovales s/n, 50006 Zaragoza, aportando fotocopia de su DNI o documento equivalente, y concretando el derecho que desea ejercer.

        </p>

    
</body>
</html>
