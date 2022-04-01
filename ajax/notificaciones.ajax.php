<?php
// ini_set('display_errors', 1);
// error_reporting(E_ALL);
require_once "../modelos/notificaciones.modelo.php";

Class AjaxNotificaciones{

	/*=============================================
	ACTUALIZAR NOTIFICACIONES
	=============================================*/

	public $tipo;
	public $codnot;

	public function ajaxActualizarNotificaciones(){

		$tipoNot = $this->tipo;

    //VALIDAR LA VISTA DE TICKETS
		if ($tipoNot == "ticket") {

      $item = "nueva_not";
			$valor = 0;
			$item2 = "id_not";
			$valor2 = $this->codnot;

			$respuesta = ModeloNotificaciones::mdlActualizarNotificaciones("tu_notificaciones", $item, $valor, $item2, $valor2);

		}else if ($tipoNot == "reclamo"){

			$item = "nueva_not";
			$valor = 0;
			$item2 = "id_not";
			$valor2 = $this->codnot;

			$respuesta = ModeloNotificaciones::mdlActualizarNotificaciones("tu_notificaciones", $item, $valor, $item2, $valor2);

		}

		echo $respuesta;

	}



}

if(isset($_POST["tipo"])){

	$actualizarNotificaciones = new AjaxNotificaciones();
	$actualizarNotificaciones -> tipo = $_POST["tipo"];
	$actualizarNotificaciones -> codnot = $_POST["codnot"];
	$actualizarNotificaciones -> ajaxActualizarNotificaciones();

}
