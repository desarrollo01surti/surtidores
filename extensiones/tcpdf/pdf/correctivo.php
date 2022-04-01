<?php

require '../../vendor/autoload.php';

//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');

class imprimirPDFCorrectivo{

// public $codigo; //se obtiene de manera publica el codigo o id mediante el metodo GET


public function traerImpresionCorrectivo(){

	$numero = 'JH210486';
	$fecha = '14 DE JULIO 2021';
	$estado = 'ESTACION DE SERV. BOLIVAR SA';
	$ubicacion = 'AV. SANTIAGO DE SURCO NRO. 4420';
	$tipo = 'DISPENSADOR';
	$marca = 'KRAUS';
	$modelo = 'KRP Y2H';
	$serie = 'HSP I-9032';
	$prueba = 'COMPARATIVA';
	$ajusteL1 = '-0.30 %';
	$ajusteL2 = '-0.30 %';

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->startPageGroup();

$pdf->AddPage();

// ---------------------------------------------------------

$bloque1 = <<<EOF

	<table>

	  <tr>

          <td><img src="images/cabecera.png"></td>

		</tr>

		<tr>

			<td style="width:10px"></td>

			<td style="background-color:white; width:500px">

				<div style="font-size:8.5px; text-align:center; line-height:10px;">

				  <h3>CONSTANCIA DE PRUEBAS DE EXACTITUD DE DESPACHO</h3>
					<br>
				</div>

			</td>

			<td style="width:10px"></td>

		</tr>

		<tr>

		    <td style="width:50px"></td>

				<td style="background-color:white; width:420px">

					<div style="font-size:10px; text-align:justify; line-height:10px;">

						Mediante la presente Surtidores S.A.C. hace constancia de haber efectuado el servicio de pruebas de exactitud de despacho de los medidores de flujo para GLP, para lo cual empleamos un medidor másico patrón.

					</div>

					<div style="font-size:10px; text-align:left; line-height:10px;">
						Servicio efectuado según documento “servicio correctivo” N° $numero.
					</div>

				</td>

				<td style="width:50px"></td>

		</tr>

		<tr>

    <td style="width:50px"></td>
		<td style="border-bottom: 1px solid #666; background-color:white; width:420px"></td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

// ---------------------------------------------------------


$bloque2 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>

    <td style="width:50px"></td>
		<td style="border: 1px solid #666; background-color:white; width:210px; text-align:left">Fecha de Calibración:</td>
		<td style="border: 1px solid #666; background-color:white; width:210px; text-align:left">$fecha</td>

		</tr>

		<tr>

    <td style="width:50px"></td>
		<td style="border: 1px solid #666; background-color:white; width:210px; text-align:left">Estado de Servicio:</td>
		<td style="border: 1px solid #666; background-color:white; width:210px; text-align:left">$estado</td>

		</tr>

		<tr>

    <td style="width:50px"></td>
		<td style="border: 1px solid #666; background-color:white; width:210px; text-align:left">Ubicación:</td>
		<td style="border: 1px solid #666; background-color:white; width:210px; text-align:left">$ubicacion</td>

		</tr>

		<tr>

    <td style="width:50px"></td>
		<td style="border: 1px solid #666; background-color:white; width:210px; text-align:left">Tipo de Equipo:</td>
		<td style="border: 1px solid #666; background-color:white; width:210px; text-align:left">$tipo</td>

		</tr>

		<tr>

    <td style="width:50px"></td>
		<td style="border: 1px solid #666; background-color:white; width:210px; text-align:left">Marca del Equipo:</td>
		<td style="border: 1px solid #666; background-color:white; width:210px; text-align:left">$marca</td>

		</tr>

		<tr>

    <td style="width:50px"></td>
		<td style="border: 1px solid #666; background-color:white; width:210px; text-align:left">Modelo:</td>
		<td style="border: 1px solid #666; background-color:white; width:210px; text-align:left">$modelo</td>

		</tr>

		<tr>

    <td style="width:50px"></td>
		<td style="border: 1px solid #666; background-color:white; width:210px; text-align:left">N° Serie del Equipo:</td>
		<td style="border: 1px solid #666; background-color:white; width:210px; text-align:left">$serie</td>

		</tr>

		<tr>

    <td style="width:50px"></td>
		<td style="border: 1px solid #666; background-color:white; width:210px; text-align:left">Tipo de prueba:</td>
		<td style="border: 1px solid #666; background-color:white; width:210px; text-align:left">$prueba</td>

		</tr>

		<tr>

    <td style="width:50px"></td>
		<td style="border: 1px solid #666; background-color:white; width:210px; text-align:left">Ajuste de calibración Lado 01:</td>
		<td style="border: 1px solid #666; background-color:white; width:210px; text-align:left">$ajusteL1</td>

		</tr>

		<tr>

    <td style="width:50px"></td>
		<td style="border: 1px solid #666; background-color:white; width:210px; text-align:left">Ajuste de calibración Lado 02:</td>
		<td style="border: 1px solid #666; background-color:white; width:210px; text-align:left">$ajusteL2</td>

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
            <br><br><br><br><br>
						Se expide la presente para los fines que el interesado estime conveniente.

					</div>

				</td>

				<td style="width:50px"></td>

		</tr>

	</table>

	<table>

				<tr><td style="height:20px"></td></tr>

				<tr>

							<td><img src="images/firma.png"></td>

				</tr>

	</table>
  <br><br><br>
	<table>

				<tr><td style="height:20px"></td></tr>

				<tr>

							<td><img src="images/footer.png"></td>

				</tr>

	</table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

// ---------------------------------------------------------


$textcorrectivo = 'correctivo_'.$numero.'.pdf';

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
