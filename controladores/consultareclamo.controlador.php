<?php

class ControladorConsultaReclamos{

  /*=============================================
  MOSTRAR RECLAMOS TABLA
  =============================================*/
  static public function ctrMostrarReclamosTabla($item, $valor){

    $tabla = "tb_reclamaciones";

    $respuesta = ModeloReclamos::mdlMostrarReclamosTabla($tabla, $item, $valor);

    return $respuesta;

  }

  /*=============================================
  MOSTRAR RECLAMOS GENERAL
  =============================================*/
  static public function ctrMostrarReclamos($item, $valor){

    $tabla = "tb_reclamaciones";

    $respuesta = ModeloReclamos::mdlMostrarReclamos($tabla, $item, $valor);

    return $respuesta;

  }

  /*=============================================
  MOSTRAR RECLAMOS Pdf Respuesta
  =============================================*/
  static public function ctrMostrarReclamosPdf($item, $valor){

    $tabla = "tb_reclamaciones";

    $respuesta = ModeloReclamos::mdlMostrarReclamosPdf($tabla, $item, $valor);

    return $respuesta;

  }

  /*=============================================
  ASIGNAR TICKETS
  =============================================*/
  static public function ctrAsignarReclamo(){

    if(isset($_POST["muestraTrabajadorReclamo"])){

      date_default_timezone_set('America/Lima');
			$fecha = date('Y-m-d');
			$hora = date('H:i:s');
			$fechaActual = $fecha . ' ' . $hora;

      $tabla ="tb_reclamaciones";
			$id = $_POST["codigoRecla"];
			$item = "responsable";
			$valor = $_POST["muestraTrabajadorReclamo"];

			//ASIGNAR RECLAMO
			$respuesta = ModeloReclamos::mdlActualizarReclamo($tabla, $item, $valor, "codigo", $id);

      //CAMBIAR ESTADO DE RECLAMO
			$item2 = "estado";
			$valor2 = "3";
			$respuestaEstado = ModeloReclamos::mdlActualizarReclamo($tabla, $item2, $valor2, "codigo", $id);

			//////////////////////////////////////////////////////////////////////////////////////////////

      /*=============================================
			  ACTUALIZAR NOTIFICACION DE RECLAMO ASIGNADO
			=============================================*/
			$tablaNot = "tu_notificaciones";
			$item = "cod_empleado";
			$valor = $_POST["muestraTrabajadorReclamo"];

			$traerNotificaciones = ModeloNotificaciones::mdlMostrarNotificacionesTipo($tablaNot, $item, $valor, 'reclamo');

			if ($traerNotificaciones) {

						$nuevoTick = (int)$traerNotificaciones["nueva_not"] + 1;

						$ActualizarNot = ModeloNotificaciones::mdlActualizarNotificaciones($tablaNot, "nueva_not", $nuevoTick, "id_not", $traerNotificaciones["id_not"]);

			}else{

				$dataNot = array("cod_empleado"=>$_POST["muestraTrabajadorReclamo"],
			                   "tipo"=>"reclamo",
											   "nueva_not"=>1,
											   "fecha"=>$fechaActual);

				$ingresarNot = ModeloNotificaciones::mdlIngresarNotificaciones($tablaNot, $dataNot);

			}

			/*=============================================
			  ACTUALIZAR NOTIFICACION DE TICKET ASIGNADO (FIN)
			=============================================*/

			//////////////////////////////////////////////////////////////////////////////////////////////////

      if ($respuesta == "ok") {

				echo '<script>

				swal({
						type: "success",
						title: "Has Asignado el Reclamo N° ' . $id . ' correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then(function(result) {
								if (result.value) {

								window.location = "reclamacionesweb";

								}
							})

				</script>';

			}

    }

  }

}
