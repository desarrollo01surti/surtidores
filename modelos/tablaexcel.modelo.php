<?php

require_once "conexion.php";

class ModeloTablaExcel{

  /*=============================================
  Crear tabla Excel
  =============================================*/

  static public function mdlCrearTablaExcel($nomtabla){

    $stmt = Conexion::conectar()->prepare("CREATE TABLE IF NOT EXISTS $nomtabla(id int(11) NOT NULL AUTO_INCREMENT, PRIMARY KEY (id)) ENGINE=InnoDB");

    if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

    $stmt -> close();

    $stmt = null;

  }


  /*=============================================
  Agregar campos a tabla excel
  =============================================*/

  static public function mdlAddCamposTabla($nomtabla, $nombre){

    $stmt = Conexion::conectar()->prepare("ALTER TABLE $nomtabla ADD `$nombre` text NOT NULL;");

    if($stmt->execute()){

      return "ok";

    }else{

      return "error";

    }

    $stmt -> close();

    $stmt = null;

  }

  /*=============================================
  Insertar registros a la tabla
  =============================================*/

  static public function mdlInsertarDatos($tabla, $datos){

    $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla VALUES ($datos)");

    if($stmt->execute()){

      return "ok";

    }else{

      return "error";

    }

    $stmt -> close();

    $stmt = null;

  }


  /*=============================================
  VACIAR TABLA TEMPORAL
  =============================================*/

  static public function mdlVaciarTablaTemporal($tabla){

    $stmt = Conexion::conectar()->prepare("TRUNCATE TABLE $tabla");

    if($stmt -> execute()){

      return "ok";

    }else{

      return "error";

    }

    $stmt -> close();

    $stmt = null;

  }

  /*=============================================
  VALIDAR EXISTENCIA DE TABLA
  =============================================*/

  static public function mdlValidarTabla($tabla){

    $stmt = Conexion::conectar()->prepare("SELECT table_name FROM information_schema.tables WHERE table_name = :tabla");

    $stmt -> bindParam(":tabla", $tabla, PDO::PARAM_STR);

    $stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

  }



}
