<?php

require_once "../../../controladores/ventas.controlador.php";
require_once "../../../modelos/ventas.modelo.php";

require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";

require_once "../../../controladores/configuracion.controlador.php";
require_once "../../../modelos/configuracion.modelo.php";

require '../../vendor/autoload.php';
use Luecano\NumeroALetras\NumeroALetras;
use Endroid\QrCode\QrCode;

class imprimirFactura{

public $codigo;

public function traerImpresionFactura(){

//TRAEMOS LA INFORMACIÓN DE LA VENTA

$itemVenta = "codigo";
$valorVenta = $this->codigo;

$respuestaVenta = ControladorVentas::ctrMostrarVentas($itemVenta, $valorVenta);

$fecha = substr($respuestaVenta["fecha"],0,-8);
$productos = json_decode($respuestaVenta["productos"], true);
$neto = number_format($respuestaVenta["neto"],2);
$impuesto = number_format($respuestaVenta["impuesto"],2);
$total = number_format($respuestaVenta["total"],2);
$formaPago = $respuestaVenta["metodo_pago"];
$estado = $respuestaVenta["estado"];

//IMPRIMIENDO MONTO TOTAL EN LETRAS
$moneda = "Soles";

$letrasSoles = ControladorVentas::ctrFacturaLetras($total,$moneda);
//$respuestaVendedor[nombre]
//TRAEMOS LA INFORMACIÓN DEL CLIENTE

$itemCliente = "id";
$valorCliente = $respuestaVenta["id_cliente"];

$respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

//TRAEMOS LA INFORMACIÓN DEL VENDEDOR

$itemVendedor = "id";
$valorVendedor = $respuestaVenta["id_vendedor"];

$respuestaVendedor = ControladorUsuarios::ctrMostrarUsuarios($itemVendedor, $valorVendedor);


//TRAEMOS INFORMACION DE LA CONFIGURACION DE DOCUMENTOS
$config = ControladorConfiguracion::ctrMostrarConfiguracion();

$nombreEmp = $config["nombre"];

$logodoc = $config["logodoc"];

$direccion = $config["direccion"];

$telefono = $config["telefono"];

$correo = $config["correo"];

$ruc = $config["ruc"];

$datoruc = "";

if ($ruc != "") {

	 $datoruc = $config["ruc"];

}else{

	 $datoruc = "##########";

}


//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->startPageGroup();

$pdf->AddPage();

// ---------------------------------------------------------

$bloque1 = <<<EOF

	<table>

		<tr>

			<td style="width:150px"><img src="../../../$logodoc"></td>

			<td style="width:10px"></td>

			<td style="background-color:white; width:240px">

				<div style="font-size:8.5px; text-align:center; line-height:10px;">

				  <h3>$nombreEmp</h3>

					<br>
					Dirección: $direccion

					<br>
					Teléfono: $telefono

					<br>
					$correo

				</div>

			</td>

			<td style="width:10px"></td>

			<td style="width:130px;">
      <div  style="border: 1px solid #666; background-color:white; text-align:center; font-size:12px;">
      			<br>RUC: $datoruc<br>FACTURA N°<br>$valorVenta<br>
      </div>

			</td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

// ---------------------------------------------------------

$bloque2 = <<<EOF

	<table style="font-size:10px; padding:3px 8px;">

	  <tr>
			<td style="background-color:light blue; text-align:center;">

				<b>INFORMACIÓN GENERAL</b>

			</td>
		</tr>

		<tr>

			<td style="background-color:white; width:350px">

				<b>Señor(es):</b> &nbsp;&nbsp;$respuestaCliente[nombre]

			</td>

			<td style="background-color:white; width:150px;">

				<b>Forma de pago:</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$formaPago

			</td>

		</tr>

		<tr>

			<td style="background-color:white; width:393px"><b>DNI:</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$respuestaCliente[documento]</td>

			<td style="background-color:white; width:150px"><b>Fecha:</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$fecha</td>

		</tr>

		<tr>

			<td style="background-color:white; width:540px"><b>Dirección:</b> &nbsp;&nbsp;$respuestaCliente[direccion]</td>

		</tr>

		<tr>

		<td style="border-bottom: 1px solid #666; background-color:white; width:540px"></td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

// ---------------------------------------------------------

$bloque3 = <<<EOF

	<table style="font-size:8px; padding:5px 10px;">

		<tr>

		<td style="border: 1px solid #666; background-color:light blue; width:60px; text-align:center"><b>CÓDIGO</b></td>
		<td style="border: 1px solid #666; background-color:light blue; width:45px; text-align:center"><b>CANT.</b></td>
		<td style="border: 1px solid #666; background-color:light blue; width:255px; text-align:center"><b>DESCRIPCIÓN</b></td>
		<td style="border: 1px solid #666; background-color:light blue; width:90px; text-align:center"><b>VALOR UNIT.</b></td>
		<td style="border: 1px solid #666; background-color:light blue; width:90px; text-align:center"><b>VALOR TOTAL</b></td>

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

$cod = $respuestaProducto["codigo"];

$valorUnitario = number_format($respuestaProducto["precio_venta"], 2);

$precioTotal = number_format($item["total"], 2);

$bloque4 = <<<EOF

	<table style="font-size:9px; padding:5px 10px;">

		<tr>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:60px; text-align:center">
				$cod
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:45px; text-align:center">
				$item[cantidad]
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:255px; text-align:center">
				$item[descripcion]
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:90px; text-align:center">S/.
				$valorUnitario
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:90px; text-align:center">S/.
				$precioTotal
			</td>


		</tr>

	</table>


EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');

}

// ---------------------------------------------------------

$formatter = new NumeroALetras();
$totalSinComa = number_format($respuestaVenta["total"], 2, '.', '');
$letras = $formatter->toInvoice($totalSinComa, 2, 'soles');

$bloque5 = <<<EOF

	<table style="font-size:9px; padding:5px 10px;">

		<tr>

			<td style="color:#333; background-color:white; width:340px; text-align:left">

				   <b>Monto en letras: </b><br>&nbsp;&nbsp;$letras

			</td>

		</tr>

		<tr>

			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:360px; text-align:center"></td>

			<td style="border: 1px solid #666;  background-color:white; width:90px; text-align:center">
				<b>Sub - Total:</b>
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:90px; font-weight: bold; text-align:center">
				S/. $neto
			</td>

		</tr>

		<tr>

			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:360px; text-align:center"></td>

			<td style="border: 1px solid #666; background-color:white; width:90px; text-align:center">
				<b>I.G.V.:</b>
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:90px; font-weight: bold; text-align:center">
				S/. $impuesto
			</td>

		</tr>

		<tr>

			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:360px; text-align:center"></td>

			<td style="border: 1px solid #666; background-color:white; width:90px; font-weight: bold; text-align:center">
				TOTAL:
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:90px; font-weight: bold; text-align:center">
				S/. $total
			</td>

		</tr>


	</table>

EOF;

$pdf->writeHTML($bloque5, false, false, false, false, '');

// ---------------------------------------------------------

//validar si es anulado o no mostrar imagen de anulado
$imagen = "";

if ($estado == 0){

   $imagen = '<img src="images/anulado.png">';

}

$bloque6 = <<<EOF

	<table style="font-size:9px; padding:5px 10px;">

		<tr>

			<td style="color:#333; background-color:white; width:340px; text-align:left"></td>

		</tr>

		<tr>

			<td style="color:#333; background-color:white; width:360px; text-align:left">

				   <b>Observaciones: </b><br>&nbsp;&nbsp;Gracias por su compra.

			</td>

			<td style="color:#333; background-color:white; width:130px; text-align:left">

           $imagen

			</td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque6, false, false, false, false, '');

// ---------------------------------------------------------

$bloque7 = <<<EOF

	<table>

		<tr>

			<td style="width:410px"><img src="images/backFact1.jpg"></td>

		</tr>

	</table>

	<table>

		<tr>

			<td style="width:410px"><img src="images/backFact1.jpg"></td>

		</tr>

	</table>

	<table style="font-size:9px; padding:5px 10px;">

		<tr>

			<td style="color:#333; background-color:white; width:540px; text-align:left">

			<hr size="3px" color="black" />

			</td>

		</tr>

		<tr>
			<td style="color:#333; background-color:white; width:90px; text-align:left">

            <img src="images/qr-devjopp.png">

			</td>

			<td style="color:#333; background-color:white; width:400px; text-align:left">

					 <b>Vendedor: </b>$respuestaVendedor[nombre]<br>&nbsp;Representación Impresa de la Factura de Venta Electrónica

			</td>
		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque7, false, false, false, false, '');

$textfactura = 'factura_'.$valorVenta.'.pdf';

// ---------------------------------------------------------
//SALIDA DEL ARCHIVO
//ob_end_clean();
$pdf->Output($textfactura, 'I');

//I: envío el archivo en línea al navegador. El visor de PDF se utiliza si está disponible.
//D: enviar al navegador y forzar la descarga de un archivo con el nombre dado por el nombre.
}

}

$factura = new imprimirFactura();
$factura -> codigo = $_GET["codigo"];
$factura -> traerImpresionFactura();

?>
