<?php
//EMPEZAR DE CERO
require '../../vendor/autoload.php';

//REQUERIMOS LA CLASE TCPDF
require_once('tcpdf_include.php');


class MYPDF extends TCPDF{

		//CABECERA DE PAGINA
		public function Header() {
				// Logo y texto
				$image_file = 'images/surti_cabecera.png';
				$this->Image($image_file, 20, 7, 65, 21, 'PNG', '', 'T', true, 300, '', false, false, 0, false, false, false);

				$image_file = 'images/texto_cabecera.png';
				$this->Image($image_file, 125, 5, 60, 22, 'PNG', '', 'T', true, 300, '', false, false, 0, false, false, false);

				//FORMATO--> Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false)
		}

		// PIE DE PAGINA
		public function Footer() {

				// Position at 15 mm from bottom
				$this->SetY(-15);

				// Imagen final
				$image_file = 'images/footer.png';
				$this->Image($image_file, 5, 262, 200, 28, 'PNG', '', 'T', true, 300, '', false, false, 0, false, false, false);

		}
}

class imprimirPDFCorrectivo{

// public $codigo; //se obtiene de manera publica el codigo o id mediante el metodo GET

public function traerImpresionCorrectivo(){

//Se ejecuta la clase extendida de TCPD con header y footer modificados
$headfooter = new MYPDF();
$headfooter ->Header();
$headfooter ->Footer();

// ---------------------------------------------------------
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Surtidores SAC');
$pdf->SetTitle('SURSA CCUM');
$pdf->SetSubject('SURSA CCUM');
$pdf->SetKeywords('Surtidores, Surtidores SAC, correctivo');

// establecer datos de encabezado predeterminados
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// establecer fuentes de encabezado y pie de página
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// establecer márgenes
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

$pdf->startPageGroup();
$pdf->AddPage();

// ----------DATOS--------------------

$numero = 'JH210486';
$fecha = '14 DE JULIO 2021';
$estacion = 'ESTACION DE SERV. BOLIVAR SA';
$ubicacion = 'AV. SANTIAGO DE SURCO NRO. 4420';
$tipo = 'DISPENSADOR';
$marca = 'KRAUS';
$modelo = 'KRP Y2H';
$serie = 'HSP I-9032';

// ------------PAGINAS----------------

$bloque1 = <<<EOF

	<table>

	  <tr>
      <td style="width:380px"></td>

			<td style="background-color:white; width:100px">

				<div style="font-size:8.5px; text-align:center; line-height:10px;">
				  <br>
				  SURSA CCUM-001
				</div>

			</td>

		</tr>

		<tr>

			<td style="width:60px"></td>

			<td style="background-color:white; width:400px">

				<div style="font-size:8.5px; text-align:center; line-height:10px;">
				  <h3>CONSTANCIA DE CAMBIO DE UNIDAD DE MEDIDA EN DISPENSADORES PARA GLP</h3>
					<br>
				</div>

			</td>

			<td style="width:40px"></td>

		</tr>

		<tr>

		    <td style="width:50px"></td>

				<td style="background-color:white; width:420px">

					<div style="font-size:10px; text-align:justify; line-height:12px;">

						Mediante la presente, Surtidores S.A.C. hace constancia de haber efectuado el servicio de cambio de unidad de medida de volumen de litros a galones americanos de un dispensador para expendio de GLP, asegurando su correcta operatividad, de acuerdo al Decreto Supremo 013-2021 EM, publicado el 21 de Mayo del 2021. Servicio efectuado según documento “Servicio Correctivo” N° $numero.

					</div>

				</td>

				<td style="width:50px"></td>

		</tr>

		<tr>

    <td style="width:420px"></td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

// ---------------------------------------------------------


$bloque2 = <<<EOF
  <br><br><br>
	<table style="font-size:10px; padding:5px 10px;">

		<tr>

    <td style="width:40px"></td>
		<td style="width:210px; text-align:left">Fecha de Servicio:</td>
		<td style="width:210px; text-align:left">$fecha</td>

		</tr>

		<tr>

    <td style="width:40px"></td>
		<td style="width:210px; text-align:left">Lugar:</td>
		<td style="width:210px; text-align:left">$estacion</td>

		</tr>

		<tr>

    <td style="width:40px"></td>
		<td style="width:210px; text-align:left">Ubicación:</td>
		<td style="width:210px; text-align:left">$ubicacion</td>

		</tr>

		<tr>

    <td style="width:40px"></td>
		<td style="width:210px; text-align:left">Tipo de Equipo:</td>
		<td style="width:210px; text-align:left">$tipo</td>

		</tr>

		<tr>

    <td style="width:40px"></td>
		<td style="width:210px; text-align:left">Marca del Equipo:</td>
		<td style="width:210px; text-align:left">$marca</td>

		</tr>

		<tr>

		<td style="width:40px"></td>
		<td style="width:210px; text-align:left">Marca del Equipo:</td>
		<td style="width:210px; text-align:left">$modelo</td>

		</tr>

		<tr>

    <td style="width:40px"></td>
		<td style="width:210px; text-align:left">N° Serie del Equipo:</td>
		<td style="width:210px; text-align:left">$serie</td>

		</tr>

		<tr>

		<td style="width:40px"></td>
		<td style="width:210px; text-align:left">Observación:</td>
		<td style="width:210px; text-align:left">$serie</td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');


// ---------------------------------------------------------

$bloque3 = <<<EOF

	<table>

		<tr>

		    <td style="width:50px"></td>

				<td style="background-color:white; width:420px">

					<div style="font-size:10px; text-align:justify; line-height:10px;">
            <br><br><br><br>
						Se expide la presente para los fines que el interesado estime conveniente.
					</div>

				</td>

				<td style="width:50px"></td>

		</tr>

	</table>
  <br><br><br>
	<table>

				<tr><td style="height:20px"></td></tr>

				<tr>

							<td><img src="images/firma.png"></td>

				</tr>

	</table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

// ---------------------------------------------------------


$textcorrectivo = 'correctivo_SURSA_CCUM_'.$numero.'.pdf';

// ---------------------------------------------------------
//SALIDA DEL ARCHIVO
//ob_end_clean();
$pdf->Output($textcorrectivo, 'I');

//I: envío el archivo en línea al navegador. El visor de PDF se utiliza si está disponible.
//D: enviar al navegador y forzar la descarga de un archivo con el nombre dado por el nombre.
}

}

$correctivo = new imprimirPDFCorrectivo();
// $factura -> codigo = $_GET["codigo"]; //descomentar cuando se requiera obtener algun codigo o ID para procesarlo
$correctivo -> traerImpresionCorrectivo();

?>
