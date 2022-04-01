<?php

require_once "conexion.php";


class ModeloPerfiles{

	/*=============================================
	MOSTRAR PERFILES FILTRADO POR AREA
	=============================================*/

	static public function mdlMostrarPerfilesArea($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

  /*=============================================
	MOSTRAR TODOS LOS PERFILES
	=============================================*/

	static public function mdlMostrarPerfiles($tabla){

		$stmt = Conexion::conectar()->prepare("CALL $tabla");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	MOSTRAR PERFIL
	=============================================*/

	static public function mdlConsultaPerfil($tabla, $valor){

		$stmt = Conexion::conectar()->prepare("CALL $tabla ($valor)");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	CREAR PERFIL
	=============================================*/

	static public function mdlIngresarPerfil($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(descripcion, idarea, estado) VALUES (:descripcion, :idarea, :estado)");

		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":idarea", $datos["idarea"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	ACTUALIZAR ACCESOS A MODULOS DEL PERFIL
	=============================================*/

	static public function mdlActualizarAccesos($tabla, $id, $item, $valor){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item = :$item WHERE idperfil = :id");

		$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt->close();
		$stmt = null;

	}

}
