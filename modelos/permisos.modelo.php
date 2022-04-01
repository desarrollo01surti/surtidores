<?php

require_once "conexion.php";

class ModeloPermisos{

  static public function mdlMostrarPermisos($tabla){

    $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

    $stmt -> execute();

    return $stmt -> fetchAll();

    $stmt -> close();

    $stmt = null;

  }

  /*=============================================
  ACTUALIZAR PERMISOS DEL PERFIL
  =============================================*/

  static public function mdlActualizarPermiso($tabla, $id, $item, $valor){

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
