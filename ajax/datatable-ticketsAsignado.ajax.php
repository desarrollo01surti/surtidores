<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once "../controladores/tickets.controlador.php";
require_once "../modelos/tickets.modelo.php";

require_once "../controladores/usuario.controlador.php";
require_once "../modelos/usuario.modelo.php";

class TablaTicketsAsignado
{

	public function mostrarTablaTicketsAsignado()
	{

		$item = "asignado";
		$valor = $_GET["id_usuario"];

		$ticketsAsig = ControladorTickets::ctrMostrarTickets($item, $valor);

		// var_dump($ticketsAsig);
		if (count($ticketsAsig) == 0) {

			echo '{ "data":[]}';

			return;
		}


		$datosJson = '{"data":[';

		foreach ($ticketsAsig as $key => $value) {

			/*=============================================
         	 ESTADO
        	=============================================*/

			if ($value["estado"] == "abierto") {

				$estado = "<span class='label label-info' idTicket=" . $value["id_soporte"] . ">" . $value["estado"] . "</span>";
			} else if ($value["estado"] == "pendiente") {

				$estado = "<span class='label label-warning' idTicket=" . $value["id_soporte"] . ">" . $value["estado"] . "</span>";
			} else if ($value["estado"] == "esperando al cliente") {

				$estado = "<span class='label label-success' idTicket=" . $value["id_soporte"] . ">" . $value["estado"] . "</span>";
			} else {

				$estado = "<span class='label label-danger' idTicket=" . $value["id_soporte"] . ">" . $value["estado"] . "</span>";
			}

			/*=============================================
				ASIGNADO
			=============================================*/
			if ($value["asignado"] == 0) {

				$asignado = "Sin Asignar";
			} else {

				$it = "idusuario";
				$val = $value["asignado"];
				$us = ControladorUsuario::ctrMostrarUsuariosFiltro($it, $val);

				$asignado = $us["usuario"];
			}

			/*=============================================
          	ULTIMA ACTUALIZACION
        	=============================================*/
			if ($value["fecha_update"] == null) {

				$fechaupdate = "-";
			} else {

				//conociendo fecha en letras
				$dias = array('Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb');
				$dia = $dias[date('w', strtotime($value["fecha_update"]))];
				//Conociendo meses en letras
				$num = date("j", strtotime($value["fecha_update"]));
				$anno = date("Y", strtotime($value["fecha_update"]));
				$mes = array('ener', 'febr', 'marz', 'abril', 'mayo', 'jun', 'jul', 'ago', 'sept', 'oct', 'nov', 'dic');
				$mes = $mes[(date('m', strtotime($value["fecha_update"])) * 1) - 1];
				$fechaAct = $dia . ', ' . $num . ' de ' . $mes . ' del ' . $anno;

				$fechaupdate = $fechaAct;
			}

			/*=======================================================
			 VALIDAR TIEMPO DE ATENCION (PRIORIDAD)
			=======================================================*/

			if ($value["estado"] == "cerrado") {

				$prioridad = "CERRADO";
			} else {

				if ($value["asignado"] == 0) {

					$fechIni = strtotime($value["fecha_soporte"]);
					$fechFin = strtotime("now");

					$resta = $fechFin - $fechIni;

					if ($resta < 432000) {
						$prioridad = "<span class='label label-success'><i class='fa fa-bell'></i> BAJA</span>";
					} else if ($resta >= 432000 && $resta <= 518400) {
						$prioridad = "<span class='label label-warning'><i class='fa fa-bell'></i> MEDIA</span>";
					} else if ($resta > 518400) {
						$prioridad = "<span class='label label-danger'><i class='fa fa-bell'></i> ALTA</span>";
					}
				} else {

					$fechIni = strtotime($value["fecha_update"]);
					$fechFin = strtotime("now");

					$resta = $fechFin - $fechIni;

					if ($resta < 432000) {
						$prioridad = "<span class='label label-success'><i class='fa fa-bell'></i> BAJA</span>";
					} else if ($resta >= 432000 && $resta <= 518400) {
						$prioridad = "<span class='label label-warning'><i class='fa fa-bell'></i> MEDIA</span>";
					} else if ($resta > 518400) {
						$prioridad = "<span class='label label-danger'><i class='fa fa-bell'></i> ALTA</span>";
					}
				}
			}


			/*=============================================
				BOTONES DE ACCIONES
			=============================================*/
			$acciones = "<button class='btn btn-primary btn-sm btnVer' codigoTK=" . $value["codigo"] . "><i class='fa fa-eye'></i> Ver</button>";


			/*=============================================
				EMAIL / FECHA - HORA
			=============================================*/
			//conociendo fecha en letras
			$dias = array('Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb');
			$dia = $dias[date('w', strtotime($value["fecha_soporte"]))];
			//Conociendo meses en letras
			$num = date("j", strtotime($value["fecha_soporte"]));
			$anno = date("Y", strtotime($value["fecha_soporte"]));
			$mes = array('ener', 'febr', 'marz', 'abril', 'mayo', 'jun', 'jul', 'ago', 'sept', 'oct', 'nov', 'dic');
			$mes = $mes[(date('m', strtotime($value["fecha_soporte"])) * 1) - 1];
			$datanew = $dia . ', ' . $num . ' de ' . $mes . ' del ' . $anno;

			$fecha_soport = $datanew;


			$datosJson .= '[

				       "' . $value["codigo"] . '",
					   "' . $prioridad . '",
				       "' . $value["asunto"] . '",
				       "' . $value["ruc"] . '",
               		   "' . $fecha_soport . '",
					   "' . $estado . '",
                       "' . $asignado . '",
					   "' . $fechaupdate . '",
                       "' . $acciones . '"

				],';
		}

		$datosJson = substr($datosJson, 0, -1);

		$datosJson .= ']}';

		echo $datosJson;
	}
	// cierre metodo


}
// cierre clase

$activarTablaTicketsAsignado = new TablaTicketsAsignado();
$activarTablaTicketsAsignado->mostrarTablaTicketsAsignado();
