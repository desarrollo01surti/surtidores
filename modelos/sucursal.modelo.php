<?php

require_once "conexion.php";

class ModeloSucursal{

  /*=============================================
    MOSTRAR SUCURSALES CON EMPRESA
  =============================================*/
  static public function mdlMostrarSucursalEmpresa($tabla){

     $stmt = Conexion::conectar()->prepare("CALL $tabla");

     $stmt -> execute();

     return $stmt -> fetchAll();

     $stmt -> close();

     $stmt = null;

  }

  /*=============================================
    MOSTRAR DATA PARA EDITAR SUCURSAL
  =============================================*/
  static public function mdlMostrarSucursalEdit($tabla, $valor){

     $stmt = Conexion::conectar()->prepare("CALL $tabla ($valor)");

     $stmt -> execute();

     return $stmt -> fetch();

     $stmt -> close();

     $stmt = null;

  }

  /*=============================================
    MOSTRAR SUCURSAL
  =============================================*/
  static public function mdlMostrarSucursal($tabla, $item, $valor, $select){

    if($item != null && $select == null){

      $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

      $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

      $stmt -> execute();

      return $stmt -> fetch();

    }else if ($select != null){

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
  REGISTRO DE SUCURSAL
  =============================================*/
  static public function mdlIngresarSucursal($tabla, $datos){

    $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigo, descripcion, idempresa, estado) VALUES (:codigo, :descripcion, :idempresa, :estado)");

    $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
    $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
    $stmt->bindParam(":idempresa", $datos["empresa"], PDO::PARAM_STR);
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
  EDITAR SUCURSAL
  =============================================*/

  static public function mdlEditarSucursal($tabla, $datos){

    $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET descripcion = :descripcion, idempresa = :idempresa WHERE codigo = :codigo");

    $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
    $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
    $stmt->bindParam(":idempresa", $datos["empresa"], PDO::PARAM_STR);

    if($stmt -> execute()){

      return "ok";

    }else{

      return "error";

    }

    $stmt -> close();

    $stmt = null;

  }

}
