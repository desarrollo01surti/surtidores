<?php

Class ControladorNotificaciones{

	/*=============================================
	MOSTRAR NOTIFICACIONES
	=============================================*/

	static public function ctrMostrarNotificaciones($item, $valor){

		$tabla = "tu_notificaciones";

		$respuesta = ModeloNotificaciones::mdlMostrarNotificaciones($tabla, $item, $valor);

		return $respuesta;

	}

	static public function ctrActualizarNotificaciones($item1, $valor1, $item2, $valor2){

		$tabla = "tu_notificaciones";

		$respuesta = ModeloNotificaciones::mdlActualizarNotificaciones($tabla, $item1, $valor1, $item2, $valor2);

		return $respuesta;

	}

}
