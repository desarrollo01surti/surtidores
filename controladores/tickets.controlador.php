<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require_once $_SERVER['DOCUMENT_ROOT'] . '/surtidores/extensiones/vendor/autoload.php';

class ControladorTickets
{

	/*=============================================
	Agregar Respuesta a Ticket (soporte)
	=============================================*/

	public function ctrAgregarRespuestaTicket()
	{

		if (isset($_POST["respuesta-text"])) {

			$adjuntosArray = array();

			if ($_POST["adjuntos2"] != "") {

				/*=============================================
				  CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LOS ARCHIVOS DEL TICKET
				=============================================*/

				$directorio = "vistas/img/tickets/" . $_POST["nroticket2"];

				/*=============================================
				  PREGUNTAMOS PRIMERO SI NO EXISTE EL DIRECTORIO PARA CREARLO
				=============================================*/

				if (!file_exists($directorio)) {

					mkdir($directorio, 0755);
				}


				$adjuntos = json_decode($_POST["adjuntos2"], true);

				foreach ($adjuntos as $key => $value) {

					$separarAdjunto = explode(";", $value);

					$separarBase64 = explode(",", $separarAdjunto[1]);
					if ($separarAdjunto[0] == "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" || $separarAdjunto[0] == "data:application/vnd.ms-excel") {
						$aleatorio = mt_rand(100, 999);

						$ruta = $directorio . "/" . $aleatorio . ".xlsx";

						$archivo = base64_decode($separarBase64[1]);

						file_put_contents($ruta, $archivo);

						array_push($adjuntosArray, $ruta);
					} else if ($separarAdjunto[0] == "data:application/vnd.openxmlformats-officedocument.wordprocessingml.document" || $separarAdjunto[0] == "data:application/msword") {

						$aleatorio = mt_rand(100, 999);

						$ruta = $directorio . "/" . $aleatorio . ".docx";

						$archivo = base64_decode($separarBase64[1]);

						file_put_contents($ruta, $archivo);

						array_push($adjuntosArray, $ruta);
					} else if ($separarAdjunto[0] == "data:application/pdf") {

						$aleatorio = mt_rand(100, 999);

						$ruta = $directorio . "/" . $aleatorio . ".pdf";

						$archivo = base64_decode($separarBase64[1]);

						file_put_contents($ruta, $archivo);

						array_push($adjuntosArray, $ruta);
					} else if ($separarAdjunto[0] == "data:image/jpeg") {

						$aleatorio = mt_rand(100, 999);

						$ruta = $directorio . "/" . $aleatorio . ".jpg";

						$archivo = base64_decode($separarBase64[1]);

						file_put_contents($ruta, $archivo);

						array_push($adjuntosArray, $ruta);
					} else if ($separarAdjunto[0] == "data:image/png") {

						$aleatorio = mt_rand(100, 999);

						$ruta = $directorio . "/" . $aleatorio . ".png";

						$archivo = base64_decode($separarBase64[1]);

						file_put_contents($ruta, $archivo);

						array_push($adjuntosArray, $ruta);
					} else {

						echo '<script>

								swal({
										type:"error",
											title: "¡CORREGIR!",
											text: "¡No se permiten formatos diferentes a JPG, PNG, EXCEL, WORD o PDF!",
											showConfirmButton: true,
										confirmButtonText: "Cerrar"

								}).then(function(result){

										if(result.value){
												window.location = "index.php?ruta=ticket-vista&cod=' . $_POST["nroticket2"] . ';
											}
								});

							</script>';
					}
				} //Finaliza el foreach de archivos adjuntos

			} //Finaliza condición cuando no hay adjuntos

			/*=============================================
				Enviamos info de la respuesta de historial del ticket al modelo
			=============================================*/
			$tabla = "tb_historial";

			/*=============================================
				Enviar respuesta de historial del ticket a soporte
			=============================================*/
			date_default_timezone_set('America/Lima');
			$fecha = date('Y-m-d');
			$hora = date('H:i:s');
			$fechaActual = $fecha . ' ' . $hora;

			$datos = array(
				"id_ticket" => $_POST["nroticket2"],
				"descripcion" => "Respuesta Ticket Soporte",
				"respuesta" => $_POST["respuesta-text"],
				"usuario" => $_POST["idUser"],
				"tipoUser" => "soporte",
				"fecha" => $fechaActual,
				"adjunto" => json_encode($adjuntosArray)
			);

			$respuesta = ModeloTicket::mdlAgregarRespuestaTicket($tabla, $datos);

			//actualizando la tabla tickets con la fecha de la ultima actualizacion
			$tablaTick = "tb_soporte";
			$actualizarTicket = ModeloTicket::mdlActualizarTicket($tablaTick, $_POST["nroticket2"], "fecha_update", $fechaActual);

			//CAMBIAR ESTADO DE TICKET
			$item2 = "estado";
			$valor2 = "esperando al cliente";
			$respuesta2 = ModeloTicket::mdlActualizarTicket($tablaTick, $_POST["nroticket2"], $item2, $valor2);

			/*=============================================
				Verificación Correo Electrónico
			=============================================*/
			$ruta = "https://www.surtidores.com.pe/tickets/";
			date_default_timezone_set("America/Lima");

			//DEVOLVER CORREO DEL TICKET
			$dataTick = ModeloTicket::mdlMostrarTickets($tablaTick, "codigo", $_POST["nroticket2"]);

			foreach ($dataTick as $key => $value2) {
			}
			/*=============================================================================
			// ENVIO DE CORREO DE AVISO A CLIENTE QUE SU RESPUESTA FUE RESPONDIDA (INICIO)
			==============================================================================*/

			if ($value2["tipo_remitente"] == "cliente") {

				$mail = new PHPMailer;

				$mail->Charset = "utf-8";

				//Server settings
				$mail->SMTPDebug = 0;
				$mail->isSMTP();
				$mail->Host = 'smtp.gmail.com';
				$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
				$mail->Username   = 'desarrollo@surtidores.com.pe';
				$mail->Password   = 'Surt1d0r3s_xx';
				$mail->SMTPSecure = 'tls';                                   //Enable implicit TLS encryption
				$mail->Port       = 587;                                     //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`


				//Recipients
				$mail->setFrom("desarrollo@surtidores.com.pe", "SURTIDORES SAC");
				$mail->addAddress($value2["email"]);
				$mail->addReplyTo("desarrollo@surtidores.com.pe", "SURTIDORES SAC");

				//Contenido de Mensaje HTML
				$mail->msgHTML('<div style="width:100%; background:#eee; position:relative; font-family:sans-serif; padding-bottom:40px">

						<center>

							<img style="padding:20px; width:10%" src="http://www.surtidores.com.pe/images/logo_surtidore.png">

						</center>

						<div style="position:relative; margin:auto; width:600px; background:white; padding:20px">

							<center>

							<img style="padding:20px; width:15%" src="https://www.surtidores.com.pe/correo.png">

							<h3 style="font-weight:100; color:#999">RESPUESTA A TICKET N° ' . $_POST["nroticket2"] . '</h3>

							<hr style="border:1px solid #ccc; width:80%">

							<h4 style="font-weight:100; color:#999; padding:0 20px"><strong>Su ticket ha sido respondido por el area de soporte. Porfavor ingrese al sistema de Tickets para visualizar la respuesta.</strong></h4>

							<a href="' . $ruta . '" target="_blank" style="text-decoration:none">

							<div style="line-height:30px; background:#0aa; width:60%; padding:20px; color:white">
								Haz click aquí
							</div>

							</a>

							<h4 style="font-weight:100; color:#999; padding:0 20px">Ingrese nuevamente al sitio con sus crendenciales para poder visualizar su ticket.</h4>

							<br>

							<hr style="border:1px solid #ccc; width:80%">

							<h5 style="font-weight:100; color:#999">Este mensaje se ha enviado por el sistema de Tickets de Surtidores SAC (http://www.surtidores.com.pe/). Por favor no responda a este correo. Si tiene dudas llámanos al (01) 441-7425</h5>

							</center>

						</div>

					</div>');

				$mail->Subject = utf8_decode("RESPUESTA DE SOPORTE A TICKET N° " . $_POST["nroticket2"] . " - SURTIDORES SAC");

				$envio = $mail->Send();

				/*=============================================================================
				// ENVIO DE CORREO DE AVISO A CLIENTE QUE SU RESPUESTA FUE RESPONDIDA (FIN)
				==============================================================================*/
			}


			if ($respuesta == "ok") {


				echo '<script>

						swal({
								type:"success",
									title: "¡SU RESPUESTA AL TICKET N° ' . $_POST["nroticket2"] . ' HA SIDO CORRECTAMENTE ENVIADA!",
									text: "¡Se espera la respuesta del cliente!",
									showConfirmButton: true,
								confirmButtonText: "Cerrar"

						}).then(function(result){

								if(result.value){
										window.location = "index.php?ruta=ticket-vista&cod=' . $_POST["nroticket2"] . '";
									}
						});

					</script>';
			}
		}
	}

	/*=============================================
	Mostrar tickets
	=============================================*/

	public static function ctrMostrarTickets($item, $valor)
	{

		$tabla = "tb_soporte";

		$respuesta = ModeloTicket::mdlMostrarTickets($tabla, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	Mostrar Ultimo Ticket
	=============================================*/

	public static function ctrMostrarUltimoTicket()
	{

		$tabla = "tb_soporte";

		$respuesta = ModeloTicket::mdlMostrarUltimoTicket($tabla);

		return $respuesta;
	}

	/*=============================================
	Mostrar Datos de ticket Elegido
	=============================================*/

	public static function ctrMostrarTicketsDatos($item, $valor)
	{

		$tabla = "tb_soporte";

		$respuesta = ModeloTicket::mdlMostrarTicketsDatos($tabla, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	Mostrar Historial
	=============================================*/

	public static function ctrMostrarHistorial($item, $valor)
	{

		$tabla = "tb_historial";

		$respuesta = ModeloTicket::mdlMostrarHistorial($tabla, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	ASIGNAR TICKET RESPONSABLE
	=============================================*/

	static public function ctrAsignarTicket()
	{

		if (isset($_POST["muestraTrabajadorTickets"])) {

			$tabla = "tb_soporte";
			$id = $_POST["codigoTik"];
			$item = "asignado";
			$valor = $_POST["muestraTrabajadorTickets"];

			//ASIGNAR TICKET
			$respuesta = ModeloTicket::mdlActualizarTicket($tabla, $id, $item, $valor);

			//CAMBIAR ESTADO DE TICKET
			$item2 = "estado";
			$valor2 = "pendiente";
			$respuestaEstado = ModeloTicket::mdlActualizarTicket($tabla, $id, $item2, $valor2);

			//////////////////////////////////////////////////////////////////////////////////////////////

			//ACTUALIZAR HISTORIAL (MUESTRA HISTORIAL DE REGISTRO DE TICKET)
			date_default_timezone_set('America/Lima');
			$fecha = date('Y-m-d');
			$hora = date('H:i:s');
			$fechaActual = $fecha . ' ' . $hora;
			$tablaHis = "tb_historial";

			$tablaUs = "tu_usuario";
			$itemUs = "idusuario";
			$usuario = ModeloUsuario::mdlMostrarUsuariosTick($tablaUs, $itemUs, $valor);

			$datos2 = array(
				"id_ticket" => $id,
				"descripcion" => "Asignación de Ticket",
				"respuesta" => "Ticket asignado a " . $usuario["usuario"],
				"usuario" => $valor,
				"tipoUser" => "soporte",
				"fecha" => $fechaActual,
				"adjunto" => "[]"
			);

			$respuesta2 = ModeloTicket::mdlAgregarRespuestaTicket($tablaHis, $datos2);

			//////////////////////////////////////////////////////////////////////////////////////////////////

			//ACTUALIZAR FECHA DE ULTIMA ACTUALIZACION
			$actualizarfecha = ModeloTicket::mdlActualizarTicket($tabla, $id, "fecha_update", $fechaActual);

			//////////////////////////////////////////////////////////////////////////////////////////////////

			/*=============================================
			  ACTUALIZAR NOTIFICACION DE TICKET ASIGNADO
			=============================================*/
			$tablaNot = "tu_notificaciones";
			$item = "cod_empleado";
			$valor = $_POST["muestraTrabajadorTickets"];

			$traerNotificaciones = ModeloNotificaciones::mdlMostrarNotificacionesTipo($tablaNot, $item, $valor, 'ticket');

			if ($traerNotificaciones) {

				$nuevoTick = (int)$traerNotificaciones["nueva_not"] + 1;

				$ActualizarNot = ModeloNotificaciones::mdlActualizarNotificaciones($tablaNot, "nueva_not", $nuevoTick, "id_not", $traerNotificaciones["id_not"]);
			} else {

				$dataNot = array(
					"cod_empleado" => $_POST["muestraTrabajadorTickets"],
					"tipo" => "ticket",
					"nueva_not" => 1,
					"fecha" => $fechaActual
				);

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
						title: "Has Asignado el ticket N° ' . $id . ' correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then(function(result) {
								if (result.value) {

								window.location = "tickets";

								}
							})

				</script>';
			}
		}
	}

	/*=============================================
	CERRAR TICKET
	=============================================*/

	static public function ctrCerrarTicket()
	{

		if (isset($_GET["CerrarTicket"])) {

			$tabla = "tb_soporte";
			$codTik = $_GET["CerrarTicket"];
			$item = "estado";
			$valor = "cerrado";

			//CERRAR TICKET
			$respuesta = ModeloTicket::mdlActualizarTicket($tabla, $codTik, $item, $valor);

			////////////////////////////////////////////////////////////////////////////////////

			//ACTUALIZAR HISTORIAL (MUESTRA HISTORIAL DE TICKET CERRADO)
			date_default_timezone_set('America/Lima');
			$fecha = date('Y-m-d');
			$hora = date('H:i:s');
			$fechaActual = $fecha . ' ' . $hora;
			$tablaHis = "tb_historial";

			//devolviendo datos de usuario
			$tablaUs = "tu_usuario";
			$itemUs = "idusuario";
			$idUS = $_GET["idUsuario"];
			$usuario = ModeloUsuario::mdlMostrarUsuariosTick($tablaUs, $itemUs, $idUS);

			$datos2 = array(
				"id_ticket" => $codTik,
				"descripcion" => "Ticket Cerrado",
				"respuesta" => "Ticket Cerrado por " . $usuario["usuario"],
				"usuario" => $idUS,
				"tipoUser" => "soporte",
				"fecha" => $fechaActual,
				"adjunto" => "[]"
			);

			$respuesta2 = ModeloTicket::mdlAgregarRespuestaTicket($tablaHis, $datos2);

			//////////////////////////////////////////////////////////////////////////////////

			//ACTUALIZAR FECHA DE ULTIMA ACTUALIZACION
			$actualizarfecha = ModeloTicket::mdlActualizarTicket($tabla, $codTik, "fecha_update", $fechaActual);

			if ($respuesta == "ok") {

				echo '<script>

				swal({
						type: "success",
						title: "El ticket N° ' . $codTik . ' fue cerrado correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then(function(result) {
								if (result.value) {

								window.location = "tickets";

								}
							})

				</script>';
			}
		}
	}

	/*=============================================
	Nuevo Ticket
	=============================================*/

	public function ctrCrearTicket()
	{

		if (isset($_POST["mensaje"])) {

			if ($_POST["mensaje"] != "") { //SE VALIDA QUE EL CAMPO MENSAJE DE TICKET NO ESTE VACIO

				$adjuntosArray = array();

				if ($_POST["adjuntos"] != "") {

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LOS ARCHIVOS DEL TICKET
					=============================================*/

					$directorio = "vistas/img/tickets/" . $_POST["codigo"];

					/*=============================================
					PREGUNTAMOS PRIMERO SI NO EXISTE EL DIRECTORIO PARA CREARLO
					=============================================*/

					if (!file_exists($directorio)) {

						mkdir($directorio, 0755);
					}


					$adjuntos = json_decode($_POST["adjuntos"], true);

					foreach ($adjuntos as $key => $value) {

						$separarAdjunto = explode(
							";",
							$value
						);

						$separarBase64 = explode(",", $separarAdjunto[1]);
						if ($separarAdjunto[0] == "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" || $separarAdjunto[0] == "data:application/vnd.ms-excel") {
							$aleatorio = mt_rand(100, 999);

							$ruta = $directorio . "/" . $aleatorio . ".xlsx";

							$archivo = base64_decode($separarBase64[1]);

							file_put_contents($ruta, $archivo);

							array_push($adjuntosArray, $ruta);
						} else if ($separarAdjunto[0] == "data:application/vnd.openxmlformats-officedocument.wordprocessingml.document" || $separarAdjunto[0] == "data:application/msword") {

							$aleatorio = mt_rand(100, 999);

							$ruta = $directorio . "/" . $aleatorio . ".docx";

							$archivo = base64_decode($separarBase64[1]);

							file_put_contents($ruta, $archivo);

							array_push($adjuntosArray, $ruta);
						} else if ($separarAdjunto[0] == "data:application/pdf") {

							$aleatorio = mt_rand(100, 999);

							$ruta = $directorio . "/" . $aleatorio . ".pdf";

							$archivo = base64_decode($separarBase64[1]);

							file_put_contents($ruta, $archivo);

							array_push($adjuntosArray, $ruta);
						} else if ($separarAdjunto[0] == "data:image/jpeg") {

							$aleatorio = mt_rand(100, 999);

							$ruta = $directorio . "/" . $aleatorio . ".jpg";

							$archivo = base64_decode($separarBase64[1]);

							file_put_contents($ruta, $archivo);

							array_push($adjuntosArray, $ruta);
						} else if ($separarAdjunto[0] == "data:image/png") {

							$aleatorio = mt_rand(100, 999);

							$ruta = $directorio . "/" . $aleatorio . ".png";

							$archivo = base64_decode($separarBase64[1]);

							file_put_contents($ruta, $archivo);

							array_push($adjuntosArray, $ruta);
						} else {

							echo '<script>

								swal({
										type:"error",
									  	title: "¡CORREGIR!",
									  	text: "¡No se permiten formatos diferentes a JPG, PNG, EXCEL, WORD o PDF!",
									  	showConfirmButton: true,
										confirmButtonText: "Cerrar"

								})

							</script>';
						}
					} //Finaliza el foreach de archivos adjuntos

				} //Finaliza condición cuando no hay adjuntos

				/*=============================================
				Enviamos info del ticket al modelo
				=============================================*/
				$tabla = "tb_soporte";

				/*=============================================
				Enviar ticket de usuario a administrador
				=============================================*/
				date_default_timezone_set('America/Lima');
				$fecha = date('Y-m-d');
				$hora = date('H:i:s');
				$fechaActu = $fecha . ' ' . $hora;

				/*=============================================
				VALIDAR ASIGNADO SEGUN MOTIVO
				=============================================*/
				$motivo = $_POST["asunto"];
				if ($motivo == "Garantia") {
					$asignado = "18"; //Asignar ID usuario Nestor Navas (Coordinador Atención al Cliente)
				} else if ($motivo == "Cambio y/o devolución") {
					$asignado = "18"; //Asignar ID usuario Nestor Navas (Coordinador Atención al Cliente)
				} else if ($motivo == "Faltante") {
					$asignado = "6"; //Asignar ID usuario Fiorela Palomino (Asistente de Logística)
				} else if ($motivo == "Incumplimiento de Servicio") {
					$asignado = "18"; //Asignar ID usuario Nestor Navas (Coordinador Atención al Cliente)
				} else {
					$asignado = "0"; //Con asignado 0 se permite al administrador de tickets asignar al responsable
				}


				$datos = array(
					"codigo" => $_POST["codigo"],
					"tienda" => $_POST["tienda"],
					"remitente" => $_POST["remitente"],
					"tipo_remitente" => "soporte",
					"asignado" => $asignado,
					"ruc" => $_POST["ruc"],
					"razonsoc" => $_POST["razonsoc"],
					"email" => $_POST["email"],
					"telefono" => $_POST["telefono"],
					"contacto" => $_POST["contacto"],
					"asunto" => $_POST["asunto"],
					"nropedido" => $_POST["npedido"],
					"mensaje" => $_POST["mensaje"],
					"estado" => "abierto",
					"fecha_soporte" => $fechaActu,
					"correo_registro" => "0",
					"adjuntos" => json_encode($adjuntosArray)
				);

				$respuesta = ModeloTicket::mdlCrearTicket($tabla, $datos);

				//////////////////////////////////////////////////////////////////////////////////////////////////

				/*=============================================
				ACTUALIZAR NOTIFICACION DE TICKET ASIGNADO
				=============================================*/
				$tablaNot = "tu_notificaciones";
				$item = "cod_empleado";

				$valor = $asignado;

				if ($valor != "0") {

					$traerNotificaciones = ModeloNotificaciones::mdlMostrarNotificaciones($tablaNot, $item, $valor);

					if ($traerNotificaciones) {

						$nuevoTick = (int)$traerNotificaciones["nueva_not"] + 1;

						$ActualizarNot = ModeloNotificaciones::mdlActualizarNotificaciones($tablaNot, "nueva_not", $nuevoTick, "id_not", $traerNotificaciones["id_not"]);
					} else {

						$dataNot = array(
							"cod_empleado" => $valor,
							"tipo" => "ticket",
							"nueva_not" => 1,
							"fecha" => $fechaActu
						);

						$ingresarNot = ModeloNotificaciones::mdlIngresarNotificaciones($tablaNot, $dataNot);
					}

					//CAMBIAR ESTADO DE TICKET
					$item2 = "estado";
					$valor2 = "pendiente";
					$respuestaEstado = ModeloTicket::mdlActualizarTicket($tabla, $_POST["codigo"], $item2, $valor2);
				}

				/*=============================================
				ACTUALIZAR NOTIFICACION DE TICKET ASIGNADO (FIN)
				=============================================*/

				//////////////////////////////////////////////////////////////////////////////////////////////

				//ACTUALIZAR HISTORIAL (MUESTRA HISTORIAL DE REGISTRO DE TICKET)
				$tablaHis = "tb_historial";

				$tablaUs = "tu_usuario";
				$itemUs = "idusuario";
				$usuario = ModeloUsuario::mdlMostrarUsuariosTick($tablaUs, $itemUs, $asignado);

				$datos2 = array(
					"id_ticket" => $_POST["codigo"],
					"descripcion" => "Asignación de Ticket",
					"respuesta" => "Ticket asignado a " . $usuario["usuario"],
					"usuario" => $asignado,
					"tipoUser" => "soporte",
					"fecha" => $fechaActu,
					"adjunto" => "[]"
				);

				$respuesta2 = ModeloTicket::mdlAgregarRespuestaTicket($tablaHis, $datos2);

				//////////////////////////////////////////////////////////////////////////////////////////////////

				//ACTUALIZAR FECHA DE ULTIMA ACTUALIZACION
				$actualizarfecha = ModeloTicket::mdlActualizarTicket(
					$tabla,
					$_POST["codigo"],
					"fecha_update",
					$fechaActu
				);

				//////////////////////////////////////////////////////////////////////////////////////////////////

				//////////////////////////////////////////////////////////////////////////////////////////////////


				if ($respuesta == "ok") {


					echo '<script>

						swal({
								type:"success",
							  	title: "¡EL TICKET HA SIDO CORRECTAMENTE REGISTRADO!",
							  	text: "¡Asigne el ticket a un responsable!",
							  	showConfirmButton: true,
								confirmButtonText: "Cerrar"

						}).then(function(result){

								if(result.value){
								    window.location = "tickets";
								  }
						});

					</script>';
				}
			} else {

				echo '<script>

						swal({
								type:"error",
							  	title: "¡LA DESCRIPCION DEL TICKET ESTA VACIO!",
							  	text: "¡Porfavor, deje una breve descripcion del ticket!",
							  	showConfirmButton: true,
								confirmButtonText: "Cerrar"

						})

					</script>';
			}
		}
	}
}
