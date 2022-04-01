<?php

require_once "conexion.php";

class ModeloNotificaciones
{

	/*=============================================
	MOSTRAR NOTIFICACIONES
	=============================================*/

	static public function mdlMostrarNotificaciones($tabla, $item, $valor)
	{

		if ($item != null) {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetchAll();
		} else {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt->execute();

			return $stmt->fetchAll();
		}

		$stmt->close();

		$stmt = null;
	}

	/*=============================================
	MOSTRAR NOTIFICACIONES
	=============================================*/

	static public function mdlMostrarNotificacionesTipo($tabla, $item, $valor, $tipo)
	{

		if ($item != null) {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE tipo = :tipo and $item = :$item");

			$stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
			$stmt->bindParam(":tipo", $tipo, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetch();
		} else {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt->execute();

			return $stmt->fetchAll();
		}

		$stmt->close();

		$stmt = null;
	}

	/*=============================================
	INGRESAR NOTIFICACION
	=============================================*/

	static public function mdlIngresarNotificaciones($tabla, $datos)
	{

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (cod_empleado, tipo, nueva_not, fecha) VALUES (:cod_empleado, :tipo, :nueva_not, :fecha)");

		$stmt->bindParam(":cod_empleado", $datos["cod_empleado"], PDO::PARAM_INT);
		$stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
		$stmt->bindParam(":nueva_not", $datos["nueva_not"], PDO::PARAM_INT);
		$stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();

		$stmt = null;
	}

	/*=============================================
	ACTUALIZAR NOTIFICACIONES POR CODIGO EMPLEADO
	=============================================*/

	static public function mdlActualizarNotificaciones($tabla, $item, $valor, $item2, $valor2)
	{

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item = :$item WHERE $item2 = :$item2");

		$stmt->bindParam(":" . $item, $valor, PDO::PARAM_INT);
		$stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_INT);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();

		$stmt = null;
	}
}
