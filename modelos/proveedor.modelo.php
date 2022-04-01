<?php

require_once "conexion.php";

class ModeloProveedor
{

	/*=============================================
  MOSTRAR MODULO
  =============================================*/
	static public function mdlMostrarProveedor($tabla, $item, $valor)
	{

		if ($item != null) {

			$stmt = Conexion::conectarSurti()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetch();
		} else {

			$stmt = Conexion::conectarSurti()->prepare("SELECT * FROM $tabla WHERE tipo='I' ORDER BY razon_social ASC");

			$stmt->execute();

			return $stmt->fetchAll();
		}

		$stmt->close();

		$stmt = null;
	}
}
