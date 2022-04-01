<?php

require_once "../../../controladores/ventas.controlador.php";
require_once "../../../modelos/ventas.modelo.php";

require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";

require_once "../../../controladores/prestamos.controlador.php";
require_once "../../../modelos/prestamos.modelo.php";



class imprimirNotaCredito{

public $codigo;

public function traerImpresionNotaCredito(){

//TRAEMOS LA INFORMACIÓN DE LA VENTA

$itemPrestamo = "codigo";
$valorPrestamo = $this->codigo;

$respuestaPrestamo = ControladorPrestamos::ctrMostrarPrestamos($itemPrestamo, $valorPrestamo);

$fechaent = substr($respuestaPrestamo["fecha_ent"],0,-8);
$fechadevol = substr($respuestaPrestamo["fecha_devol"],0,-8);
$productos = json_decode($respuestaPrestamo["productos"], true);
//$neto = number_format($respuestaPrestamo["neto"],2);
//$impuesto = number_format($respuestaPrestamo["impuesto"],2);
//$total = number_format($respuestaPrestamo["total"],2);

//TRAEMOS LA INFORMACIÓN DEL ENCARGADO DEL REGISTRO

$itemRegistro = "id";
$valorRegistro = $respuestaPrestamo["id_reg"];

$respuestaRegistro = ControladorUsuarios::ctrMostrarUsuarios($itemRegistro, $valorRegistro);

//TRAEMOS LA INFORMACIÓN DEL SOLICITANTE

$itemSolicitante = "id";
$valorSolicitante = $respuestaPrestamo["id_solicitante"];

$respuestaSolicitante = ControladorUsuarios::ctrMostrarUsuarios($itemSolicitante, $valorSolicitante);

//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->startPageGroup();

$pdf->AddPage();

// ---------------------------------------------------------

$bloque1 = <<<EOF

<table>

	<tr>

		<td style="width:150px"><img src="images/logo-viamar-bloque-documento.png"></td>

		<td style="width:10px"></td>

		<td style="background-color:white; width:240px">

			<div style="font-size:8.5px; text-align:center; line-height:15px;">

				<br>
				Dirección: Sec. Leoncio Prado - San Juan de Miraflores - Lima

				<br>
				Teléfono: 946 524 165

				<br>
				proyectos@viamarglass.com

			</div>

		</td>

		<td style="width:10px"></td>

		<td style="background-color:white; width:110px; text-align:center; color:red">


		<br><br>RUC: 20600983602<br>Nota de Credito <br>N° $valorPrestamo

		</td>

	</tr>

</table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

// ---------------------------------------------------------

$bloque2 = <<<EOF

	<table>

		<tr>

			<td style="width:540px"><img src="images/back.jpg"></td>

		</tr>

	</table>

	<table style="font-size:10px; padding:5px 10px;">

		<tr>

			<td style="border: 1px solid #666; background-color:white; width:360px">

				Registro: $respuestaRegistro[nombre]

			</td>

			<td style="border: 1px solid #666; background-color:white; width:180px; text-align:right">

				Fecha Entrega: $fechaent

			</td>

		</tr>

		<tr>

			<td style="border: 1px solid #666; background-color:white; width:360px">

			Solicitante: $respuestaSolicitante[nombre]

			</td>

			<td style="border: 1px solid #666; background-color:white; width:180px; text-align:right">

			Fecha Devolución: $fechadevol

			</td>

		</tr>

		<tr>

		<td style="border-bottom: 1px solid #666; background-color:white; width:540px"></td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

// ---------------------------------------------------------

$bloque3 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>

		<td style="border: 1px solid #666; background-color:light blue; width:410px; text-align:center">Producto</td>
		<td style="border: 1px solid #666; background-color:light blue; width:130px; text-align:center">Cantidad</td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

// ---------------------------------------------------------

foreach ($productos as $key => $item) {

$itemProducto = "descripcion";
$valorProducto = $item["descripcion"];
$orden = null;

$respuestaProducto = ControladorProductos::ctrMostrarProductos($itemProducto, $valorProducto, $orden);

//$valorUnitario = number_format($respuestaProducto["precio_venta"], 2);

//$precioTotal = number_format($item["total"], 2);

$bloque4 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:410px; text-align:center">
				$item[descripcion]
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:130px; text-align:center">
				$item[cantidad]
			</td>

		</tr>

	</table>


EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');

}

// ---------------------------------------------------------

$textfactura = 'notacredito_'.$valorPrestamo.'.pdf';

// ---------------------------------------------------------
//SALIDA DEL ARCHIVO
//ob_end_clean();
$pdf->Output($textfactura, 'I');

//I: envío el archivo en línea al navegador. El visor de PDF se utiliza si está disponible.
//D: enviar al navegador y forzar la descarga de un archivo con el nombre dado por el nombre.
}

}

$factura = new imprimirNotaCredito();
$factura -> codigo = $_GET["codigo"];
$factura -> traerImpresionNotaCredito();

?>
