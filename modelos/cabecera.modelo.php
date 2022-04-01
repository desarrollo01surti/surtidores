<?php

require_once "conexion.php";

class ModeloCabecera{

  /*=============================================
  MOSTRAR CABECERA
  =============================================*/

  static public function mdlMostrarCabecera($tabla){

    $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

    $stmt -> execute();

    return $stmt -> fetchAll();

    $stmt -> close();

    $stmt = null;

  }


  /*=============================================
  DEVOLVER MAXIMA COLUMNA OBTENIDA
  =============================================*/

  static public function mdlMostrarMaxColum(){

    $stmt = Conexion::conectar()->prepare("SELECT MAX(columna)as col FROM pre_ingreso");

    $stmt -> execute();

    return $stmt -> fetch();

    $stmt -> close();

    $stmt = null;

  }

  /*=============================================
  MOSTRAR RUTA
  =============================================*/

  static public function mdlMostrarRuta($tabla, $item, $valor){

  		if($item != null){

  			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id ASC");

  			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

  			$stmt -> execute();

  			return $stmt -> fetch();

  		}else{

  			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id ASC");

  			$stmt -> execute();

  			return $stmt -> fetchAll();

  		}

  		$stmt -> close();

  		$stmt = null;

  }

	/*=============================================
	INGRESO DE DATOS A LA BD CABECERA
	=============================================*/

  static public function mdlIngresarCabecera($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(descripcion, columna, checked, codigo) VALUES (:descripcion, :columna, :checked, :codigo)");

		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":columna", $datos["columna"], PDO::PARAM_INT);
    $stmt->bindParam(":checked", $datos["checked"], PDO::PARAM_INT);
    $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt->close();

		$stmt = null;

	}


  /*=============================================
  INGRESO DE DATOS A LA BD RUTA
  =============================================*/

  static public function mdlIngresarRuta($tabla, $datos){

    $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(ruta, codigo, rangoColum, rangoFila) VALUES (:ruta, :codigo, :rangoColum, :rangoFila)");

    $stmt->bindParam(":ruta", $datos["ruta"], PDO::PARAM_STR);
    $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
    $stmt->bindParam(":rangoColum", $datos["rangoColum"], PDO::PARAM_STR);
    $stmt->bindParam(":rangoFila", $datos["rangoFila"], PDO::PARAM_STR);

    if($stmt->execute()){

      return "ok";

    }else{

      return "error";

    }

    $stmt->close();

    $stmt = null;

  }

}
