<?php

require_once "conexion.php";

class ModeloEmpresas{

  static public function mdlMostrarEmpresas($tabla, $item, $valor){

    if($item != null){

      $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

      $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

      $stmt -> execute();

      return $stmt -> fetch();

    }else{

      $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

      $stmt -> execute();

      return $stmt -> fetchAll();

    }

    $stmt -> close();

    $stmt = null;

  }

  /*=============================================
  REGISTRO DE EMPRESA
  =============================================*/
  static public function mdlIngresarEmpresa($tabla, $datos){

    $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigo, descripcion, ruc, logo, estado) VALUES (:codigo, :descripcion, :ruc, :logo, :estado)");

    $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
    $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
    $stmt->bindParam(":ruc", $datos["ruc"], PDO::PARAM_STR);
    $stmt->bindParam(":logo", $datos["logo"], PDO::PARAM_STR);
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
  EDITAR EMPRESAS
  =============================================*/

  static public function mdlEditarEmpresa($tabla, $datos){

    $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET descripcion = :descripcion, ruc = :ruc, logo = :logo WHERE codigo = :codigo");

    $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
    $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
    $stmt->bindParam(":ruc", $datos["ruc"], PDO::PARAM_STR);
    $stmt->bindParam(":logo", $datos["logo"], PDO::PARAM_STR);

    if($stmt -> execute()){

      return "ok";

    }else{

      return "error";

    }

    $stmt -> close();

    $stmt = null;

  }

}
