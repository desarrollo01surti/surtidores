<?php
// ini_set('display_errors', 1);
// error_reporting(E_ALL);
require_once $_SERVER['DOCUMENT_ROOT'] . '/surtidores/controladores/consultareclamo.controlador.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/surtidores/modelos/reclamaciones.modelo.php';

//REQUERIMOS LA CLASE TCPDF

require_once($_SERVER['DOCUMENT_ROOT'] . '/surtidores/extensiones/tcpdf/pdf/tcpdf_include.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/surtidores/extensiones/tcpdf/tcpdf.php');

// echo $_SERVER['DOCUMENT_ROOT'].'/surtidores/extensiones/tcpdf/tcpdf.php';

class MYPDF2 extends TCPDF
{

	//CABECERA DE PAGINA
	public function Header()
	{
		// Logo y texto
		$image_file = $_SERVER['DOCUMENT_ROOT'] . '/surtidores/extensiones/tcpdf/pdf/images/surti_cabecera.png';
		$this->Image($image_file, 20, 7, 65, 21, 'PNG', '', 'T', true, 300, '', false, false, 0, false, false, false);

		$image_file = $_SERVER['DOCUMENT_ROOT'] . '/surtidores/extensiones/tcpdf/pdf/images/texto_cabecera.png';
		$this->Image($image_file, 125, 5, 60, 22, 'PNG', '', 'T', true, 300, '', false, false, 0, false, false, false);

		//FORMATO--> Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false)
	}

	// PIE DE PAGINA
	// public function Footer() {
	//
	// 		// Position at 15 mm from bottom
	// 		$this->SetY(-15);
	//
	// 		// Imagen final
	// 		$image_file = 'images/footer.png';
	// 		$this->Image($image_file, 5, 262, 200, 28, 'PNG', '', 'T', true, 300, '', false, false, 0, false, false, false);
	//
	// }
}

class imprimirPDFReclamo2
{

	// public $codigo; //se obtiene de manera publica el codigo o id mediante el metodo GET

	public function traerImpresionReclamo2($codigo)
	{

		// ----------DATOS--------------------

		//TRAEMOS LA INFORMACIÓN DEL RECLAMO

		$itemReclamo = "codigo";
		$valorReclamo = $codigo;

		$respuestaReclamo = ControladorConsultaReclamos::ctrMostrarReclamosPdf($itemReclamo, $valorReclamo);

		$nombre = $respuestaReclamo["nombre"];
		$domicilio = $respuestaReclamo["domicilio"];
		$fecha = $respuestaReclamo["fecha"];
		$documento = $respuestaReclamo["documento"];
		$telefono = $respuestaReclamo["telefono"];
		$correo = $respuestaReclamo["correo"];
		$tipo_bien = $respuestaReclamo["tipo_bien"];
		$descripcion = $respuestaReclamo["descripcion"];
		$monto_reclamado = $respuestaReclamo["monto_reclamado"];
		$tipo_reclamo = $respuestaReclamo["tipo_reclamo"];
		$detalle = $respuestaReclamo["detalle"];
		$pedido = $respuestaReclamo["pedido"];
		$fecha_res = $respuestaReclamo["fecharesp"];
		$respuest = $respuestaReclamo["detalle_respuesta"];

		//Se ejecuta la clase extendida de TCPD con header y footer modificados
		$headfooter = new MYPDF2();
		$headfooter->Header();
		$headfooter->Footer();

		// ---------------------------------------------------------
		$pdf = new MYPDF2(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Surtidores SAC');
		$pdf->SetTitle('Hoja de reclamacion');
		$pdf->SetSubject('Hoja de reclamacion');
		$pdf->SetKeywords('Surtidores, Surtidores SAC, Hoja de Reclamacion');

		// establecer datos de encabezado predeterminados
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

		// establecer fuentes de encabezado y pie de página
		$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// establecer márgenes
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		$pdf->startPageGroup();
		$pdf->AddPage();

		// date_default_timezone_set('America/Lima');

		// $fecha = date('d/m/Y');

		// ----------------------PAGINAS----------------

		$bloque1 = <<<EOF

	<table>

		<tr>

			<td style="background-color:white; width:500px">

				<div style="font-size:8.5px; text-align:center; line-height:10px;">
				  <h2>Libro de Reclamaciones Virtual</h2>
					<br>
				</div>

			</td>

		</tr>

		<tr>
				<td style="width:40px"></td>
				<td style="width:210px; text-align:left"><b>Hoja de Reclamación N° $valorReclamo</b></td>
				<td style="width:210px; text-align:right"><small class="pull-right">Fecha: $fecha</small></td>

		</tr>

		<tr>
		   <td style="border-bottom: 1px solid Silver; width:100%"></td><br>
		</tr>

		<tr>
				<div style="font-size:8.5px; text-align:center; line-height:10px;">
					<center>SURTIDORES S.A.C. RUC N°: 20100674212 <br> Av. Angamos Oeste N° 1420, Miraflores, Lima</center>
				</div>

		</tr>

		<tr>
		   <td style="border-bottom: 1px solid Silver; width:100%"></td><br>
		</tr>

	</table>

EOF;

		$pdf->writeHTML($bloque1, false, false, false, false, '');

		// ---------------------------------------------------------

		$bloque2 = <<<EOF
  <br><br>
	<table style="font-size:10px; padding:1px 10px;">

		<tr>

			<td style="width:100%; text-align:left; background-color: #bebebe; padding-top: 7px!important; padding-bottom: 7px!important;">
			1. IDENTIFICACIÓN DEL CONSUMIDOR RECLAMANTE
			</td>

		</tr>

		<br>

		<tr>
		<td style="width:80px; text-align:left"><b>NOMBRE:</b></td>
		<td style="width:210px; text-align:left">$nombre</td>
		</tr>

		<tr>
		<td style="width:80px; text-align:left"><b>DOMICILIO:</b></td>
		<td style="width:210px; text-align:left">$domicilio</td>

		</tr>

		<tr>
		<td style="width:80px; text-align:left"><b>DNI/CE:</b></td>
		<td style="width:70px; text-align:left">$documento</td>
		<td style="width:55px; text-align:left"><b>TELEF:</b></td>
		<td style="width:72px; text-align:left">$telefono</td>
		<td style="width:55px; text-align:left"><b>EMAIL:</b></td>
		<td style="width:170px; text-align:left">$correo</td>

		</tr>

		<tr>
		   <td style="border-bottom: 1px solid Silver;  background-color:white; width:100%"></td><br>
		</tr>

	</table>

EOF;

		$pdf->writeHTML($bloque2, false, false, false, false, '');


		// ---------------------------------------------------------


		$bloque3 = <<<EOF

<table style="font-size:10px; padding:1px 10px;">

	<tr>
    <td style="width:100%; text-align:left; background-color: #bebebe; padding-top: 7px!important; padding-bottom: 7px!important;">
		2. IDENTIFICACIÓN DEL BIEN CONTRATADO
		</td>
	</tr>

	<br>

	<tr>
			<td style="width:150px; text-align:left"><b><input type="radio" name="optradiob" value="$tipo_bien" checked>$tipo_bien</b></td>
			<td style="width:140px; text-align:left"><b>MONTO RECLAMADO:</b></td>
			<td style="width:200px; text-align:left">$monto_reclamado</td>
	</tr>

	<tr>
			<td style="width:150px; text-align:left"><b></b></td>
			<td style="width:140px; text-align:left"><b>DESCRIPCION:</b></td>
			<td style="width:200px; text-align:left">$descripcion</td>
	</tr>

	<tr>
		 <td style="border-bottom: 1px solid Silver;  background-color:white; width:68.5%"></td><br>
	</tr>

</table>

EOF;

		$pdf->writeHTML($bloque3, false, false, false, false, '');

		// ---------------------------------------------------------

		$bloque4 = <<<EOF

<table style="font-size:10px; padding:1px 10px;">

	<tr>

		<td style="width:350px; text-align:left; background-color: #bebebe; padding-top: 7px!important; padding-bottom: 7px!important;">3. DETALLE DE LA RECLAMACIÓN Y PEDIDO DEL CONSUMIDOR</td>
		<td style="width:100px; text-align:left"><b><input type="radio" name="optradioT" value="$tipo_reclamo" checked>$tipo_reclamo<sup>1</sup></b></td>

	</tr>

	<br>

	<tr>
     <td><b>Detalle:</b></td>
	</tr>

	<tr>
			<td style="width:100%; font-size:8.5px; text-align:left">$detalle</td>
	</tr>

	<br>

	<tr>
		 <td><b>Pedido:</b></td>
	</tr>

	<tr>
			<td style="width:100%; font-size:8.5px; text-align:left">$pedido</td>
	</tr>

	<tr>
		 <td style="border-bottom: 1px solid Silver;  background-color:white; width:100%"></td><br>
	</tr>


</table>

EOF;

		$pdf->writeHTML($bloque4, false, false, false, false, '');

		// ---------------------------------------------------------

		$bloque4 = <<<EOF

	<table style="font-size:10px; padding:1px 10px;">

		<tr>
			<td style="width:100%; text-align:left; background-color: #bebebe; padding-top: 7px!important; padding-bottom: 7px!important;">
			4. OBSERVACIONES Y ACCIONES ADOPTADAS POR EL PROVEEDOR
			</td>
		</tr>

		<br>

		<tr>
		<td style="width:280px; text-align:left"><b>FECHA DE COMUNICACIÓN DE LA RESPUESTA:</b></td>
		<td style="width:210px; text-align:left">$fecha_res</td>

		</tr>

		<br>

		<tr>
				<td style="width:100%; font-size:8.5px; text-align:left">$respuest</td>
		</tr>

		<tr>
			 <td style="border-bottom: 1px solid Silver;  background-color:white; width:100%"></td><br>
		</tr>

	</table>

EOF;

		$pdf->writeHTML($bloque4, false, false, false, false, '');

		// ---------------------------------------------------------

		$bloque5 = <<<EOF

	<table style="font-size:6px; padding:1px 10px;">

	  <br>

		<tr>

		<td style="width:220px; text-align:left"><strong>RECLAMO<sup>1</sup>:</strong> Disconformidad relacionada a los productos o servicios.</td>
		<td style="width:280px; text-align:left"><strong>QUEJA<sup>2</sup>:</strong> Disconformidad no relacionada a los productos o servicios, o, malestar o descontento respecto a la atención al público.</td>

		</tr>

		<tr>
			 <td style="border-bottom: 1px solid Silver;  background-color:white; width:100%"></td><br>
		</tr>

		<tr>

			 <td style="font-size:5.5px;">
			 <p>
			 	Se le informa que sus datos serán almacenados en el banco de “Clientes” de titularidad SURTIDORES S.A.C., Av. Angamos Oeste N° 1420, Miraflores, Lima – Perú por un plazo indeterminado, a fin de dar respuesta a sus quejas y reclamos, así
			 	como llevar un registro de los mismos con el propósito de cumplir con las normas de protección al consumidor. Se deja constancia que: (i) el detalle de los terceros con acceso a los datos personales y cualquier variación de estos será
			 	actualizada en siguiente <a href="http://www.surtidores.com.pe/politicas-privacidad.php" target="_blank"> enlace</a>; (ii) el tratamiento de sus datos personales es necesario para cumplir con la normativa de protección y defensa de los consumidores; y, (iii) podrá
			 	ejercer los derechos previstos en la Ley N° 29733, presentándose físicamente en la dirección fiscal de Surtidores S.A.C con el asunto “Derechos Datos Personales”.
			 </p>
			 <p>* La formulación del reclamo no impide acudir a otras vias de solución de
			 	controversias ni es requisito previo para interponer una denuncia ante el INDECOPI.<br>
			 	* El proveedor deberá dar respuesta al reclamo en un plazo no mayor a (30) días calendario, pudiendo
			 	ampliar el plazo hasta por treinta (30) días más, previa comunicación al consumidor.</p>
			 </td>

		</tr>

		<br>

	</table>

EOF;

		$pdf->writeHTML($bloque5, false, false, false, false, '');

		// ---------------------------------------------------------


		$textreclamo = $valorReclamo . '.pdf';

		// ---------------------------------------------------------
		//SALIDA DEL ARCHIVO
		//ob_end_clean();
		$ruta = __DIR__ . "/reclamos";
		$rutaNl = $ruta . "/" . $textreclamo;

		$tabla2 = "tb_reclamaciones";

		$item1 = "ruta";
		$valor1 = $rutaNl;
		$item2 = "codigo";
		$valor2 = $codigo;

		ModeloReclamos::mdlActualizarReclamo($tabla2, $item1, $valor1, $item2, $valor2);

		$pdf->Output($rutaNl, 'F');

		//I: envío el archivo en línea al navegador. El visor de PDF se utiliza si está disponible.
		//D: enviar al navegador y forzar la descarga de un archivo con el nombre dado por el nombre.
		//F: GUARDAR EL ARCHIVO
	}
}

// $reclamacion = new imprimirPDFReclamo();
// $reclamacion -> codigo = $_GET["codigo"]; //descomentar cuando se requiera obtener algun codigo o ID para procesarlo
// $reclamacion -> traerImpresionReclamo();
