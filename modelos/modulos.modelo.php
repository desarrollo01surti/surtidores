<?php

require_once "conexion.php";

class ModeloModulos{

  /*=============================================
  MOSTRAR MODULO
  =============================================*/
  static public function mdlMostrarModulos($tabla, $item, $valor){

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

  static public function mdlMostrarSubModulos($tabla, $item, $valor){

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

  static public function mdlMostrarTriModulos($tabla, $item, $valor){

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

  static public function mdlValidarModulos($tabla, $item, $valor){

    $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

    $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

    $stmt -> execute();

    return $stmt -> fetchAll();

    $stmt -> close();

    $stmt = null;

  }

  /*=============================================
  MOSTRAR TODOS LOS SUBMODULOS EN TABLA
  =============================================*/

  static public function mdlMostrarSubModulosTabla($tabla){

    $stmt = Conexion::conectar()->prepare("CALL $tabla");

    $stmt -> execute();

    return $stmt -> fetchAll();

    $stmt -> close();

    $stmt = null;

  }

  /*=============================================
  MOSTRAR TODOS LOS TRIMODULOS EN TABLA
  =============================================*/

  static public function mdlMostrarTriModulosTabla($tabla){

    $stmt = Conexion::conectar()->prepare("CALL $tabla");

    $stmt -> execute();

    return $stmt -> fetchAll();

    $stmt -> close();

    $stmt = null;

  }

  /*=============================================
  MOSTRAR SUBMODULOS FILTRADOS POR ID
  =============================================*/

  static public function mdlMostrarSubModuloByID($tabla, $valor){

    $stmt = Conexion::conectar()->prepare("CALL $tabla ('$valor')");

    $stmt -> execute();

    return $stmt -> fetchAll();

    $stmt -> close();

    $stmt = null;

  }

  /*=============================================
  MOSTRAR TRIMODULOS FILTRADOS POR ID
  =============================================*/

  static public function mdlMostrarTriModuloByID($tabla, $valor){

    $stmt = Conexion::conectar()->prepare("CALL $tabla ('$valor')");

    $stmt -> execute();

    return $stmt -> fetchAll();

    $stmt -> close();

    $stmt = null;

  }

  /*=============================================
  CREAR MODULO NIVEL 1
  =============================================*/
  static public function mdlCrearModuloN1($tabla, $datos){

    $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(descripcion, ruta, icono) VALUES (:descripcion, :ruta, :icono)");

    $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
    $stmt->bindParam(":ruta", $datos["ruta"], PDO::PARAM_STR);
    $stmt->bindParam(":icono", $datos["icono"], PDO::PARAM_STR);

    if ($stmt->execute()) {

      return "ok";

    }else{

      return "error";

    }

    $stmt->close();
    $stmt = null;

  }

  /*=============================================
  CREAR MODULO NIVEL 2
  =============================================*/
  static public function mdlCrearModuloN2($tabla, $datos){

    $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(descripcion, idmodulo, ruta) VALUES (:descripcion, :idmodulo, :ruta)");

    $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
    $stmt->bindParam(":idmodulo", $datos["idmodulo"], PDO::PARAM_INT);
    $stmt->bindParam(":ruta", $datos["ruta"], PDO::PARAM_STR);

    if ($stmt->execute()) {

      return "ok";

    }else{

      return "error";

    }

    $stmt->close();
    $stmt = null;

  }

  /*=============================================
  CREAR MODULO NIVEL 3
  =============================================*/
  static public function mdlCrearModuloN3($tabla, $datos){

    $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(descripcion, idsubmod, ruta) VALUES (:descripcion, :idsubmod, :ruta)");

    $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
    $stmt->bindParam(":idsubmod", $datos["idsubmod"], PDO::PARAM_INT);
    $stmt->bindParam(":ruta", $datos["ruta"], PDO::PARAM_STR);

    if ($stmt->execute()) {

      return "ok";

    }else{

      return "error";

    }

    $stmt->close();
    $stmt = null;

  }

  /*=============================================
  EDITAR MODULO NIVEL 1
  =============================================*/

  static public function mdlEditarModuloN1($tabla, $datos){

    $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET descripcion = :descripcion, icono = :icono WHERE idmodulo = :idmodulo");

    $stmt->bindParam(":idmodulo", $datos["idmodulo"], PDO::PARAM_INT);
    $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
    $stmt->bindParam(":icono", $datos["icono"], PDO::PARAM_STR);

    if($stmt -> execute()){

      return "ok";

    }else{

      return "error";

    }

    $stmt -> close();

    $stmt = null;

  }

  /*=============================================
  EDITAR MODULO NIVEL 2
  =============================================*/

  static public function mdlEditarModuloN2($tabla, $datos){

    $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET descripcion = :descripcion, idmodulo = :idmodulo, ruta = :ruta WHERE idsubmod = :idsubmod");

    $stmt->bindParam(":idmodulo", $datos["idmodulo"], PDO::PARAM_INT);
    $stmt->bindParam(":idsubmod", $datos["idsubmod"], PDO::PARAM_INT);
    $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
    $stmt->bindParam(":ruta", $datos["ruta"], PDO::PARAM_STR);

    if($stmt -> execute()){

      return "ok";

    }else{

      return "error";

    }

    $stmt -> close();

    $stmt = null;

  }

  /*=============================================
  EDITAR MODULO NIVEL 3
  =============================================*/

  static public function mdlEditarModuloN3($tabla, $datos){

    $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET descripcion = :descripcion, idsubmod = :idsubmod, ruta = :ruta WHERE idtmod = :idtmod");

    $stmt->bindParam(":idtmod", $datos["idtmod"], PDO::PARAM_INT);
    $stmt->bindParam(":idsubmod", $datos["idsubmod"], PDO::PARAM_INT);
    $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
    $stmt->bindParam(":ruta", $datos["ruta"], PDO::PARAM_STR);

    if($stmt -> execute()){

      return "ok";

    }else{

      return "error";

    }

    $stmt -> close();

    $stmt = null;

  }

}
