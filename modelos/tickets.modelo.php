<?php

require_once "conexion.php";

class ModeloTicket
{

	/*=============================================
	Crear Respuesta de Ticket (soporte)
	=============================================*/

	static public function mdlAgregarRespuestaTicket($tabla, $datos)
	{

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id_ticket, descripcion, respuesta, adjunto, usuario, tipoUser, fecha) VALUES (:id_ticket, :descripcion, :respuesta, :adjunto, :usuario, :tipoUser, :fecha)");

		$stmt->bindParam(":id_ticket", $datos["id_ticket"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":respuesta", $datos["respuesta"], PDO::PARAM_STR);
		$stmt->bindParam(":adjunto", $datos["adjunto"], PDO::PARAM_STR);
		$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":tipoUser", $datos["tipoUser"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			echo "\nPDO::errorInfo():\n";
			print_r(Conexion::conectar()->errorInfo());
		}

		$stmt->close();

		$stmt = null;
	}

	/*=============================================
	Mostrar ticket
	=============================================*/

	static public function mdlMostrarTickets($tabla, $item, $valor)
	{

		if ($item != null && $valor != null) {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id_soporte DESC");

			$stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetchAll();
		} else {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id_soporte DESC");

			$stmt->execute();

			return $stmt->fetchAll();
		}

		$stmt->close();

		$stmt = null;
	}

	/*=============================================
	Mostrar Ultimo ticket
	=============================================*/

	static public function mdlMostrarUltimoTicket($tabla)
	{

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_soporte = (SELECT MAX(id_soporte) FROM $tabla)");

		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();

		$stmt = null;
	}

	/*=============================================
	Mostrar Datos de ticket Elegido
	=============================================*/

	static public function mdlMostrarTicketsDatos($tabla, $item, $valor)
	{

		if ($item != null && $valor != null) {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetch();
		} else {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt->execute();

			return $stmt->fetchAll();
		}
	}

	/*=============================================
	ACTUALIZAR TICKET
	=============================================*/

	static public function mdlActualizarTicket($tabla, $id, $item, $valor)
	{

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item = :$item WHERE codigo = :codigo");

		$stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
		$stmt->bindParam(":codigo", $id, PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			echo "\nPDO::errorInfo():\n";
			print_r(Conexion::conectar()->errorInfo());
		}

		$stmt->close();

		$stmt = null;
	}

	/*=============================================
	MOSTRAR TICKET HISTORIAL
	=============================================*/

	static public function mdlMostrarHistorial($tabla, $item, $valor)
	{

		if ($item != null && $valor != null) {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY fecha ASC");

			$stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetchAll();
		} else {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt->execute();

			return $stmt->fetchAll();
		}
	}

	/*=============================================
	Crear Ticket
	=============================================*/

	static public function mdlCrearTicket($tabla, $datos)
	{

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (codigo, tienda, remitente, tipo_remitente, asignado, asunto, ruc, razonsoc, email, telefono, contacto, nropedido, mensaje, fecha_soporte, estado, adjuntos, correo_registro) VALUES (:codigo, :tienda, :remitente, :tipo_remitente, :asignado, :asunto, :ruc, :razonsoc, :email, :telefono, :contacto, :nropedido, :mensaje, :fecha_soporte, :estado, :adjuntos, :correo_registro)");

		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":tienda", $datos["tienda"], PDO::PARAM_STR);
		$stmt->bindParam(":remitente", $datos["remitente"], PDO::PARAM_INT);
		$stmt->bindParam(":tipo_remitente", $datos["tipo_remitente"], PDO::PARAM_STR);
		$stmt->bindParam(":asignado", $datos["asignado"], PDO::PARAM_INT);
		$stmt->bindParam(":razonsoc", $datos["razonsoc"], PDO::PARAM_STR);
		$stmt->bindParam(":ruc", $datos["ruc"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt->bindParam(":nropedido", $datos["nropedido"], PDO::PARAM_STR);
		$stmt->bindParam(":contacto", $datos["contacto"], PDO::PARAM_STR);
		$stmt->bindParam(":asunto", $datos["asunto"], PDO::PARAM_STR);
		$stmt->bindParam(":mensaje", $datos["mensaje"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_soporte", $datos["fecha_soporte"], PDO::PARAM_STR);
		$stmt->bindParam(":correo_registro", $datos["correo_registro"], PDO::PARAM_STR);
		$stmt->bindParam(":adjuntos", $datos["adjuntos"], PDO::PARAM_STR);


		if ($stmt->execute()) {

			return "ok";
		} else {

			echo "\nPDO::errorInfo():\n";
			print_r(Conexion::conectar()->errorInfo());
		}

		$stmt->close();

		$stmt = null;
	}
}
