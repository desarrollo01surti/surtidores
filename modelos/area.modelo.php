<?php

require_once "conexion.php";


class ModeloAreas{

  static public function mdlMostrarAreas($tabla, $item, $valor){

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
  CREAR AREA
  =============================================*/
  static public function mdlCrearArea($tabla, $datos){

    $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(descripcion, acro) VALUES (:descripcion, :acro)");

    $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
    $stmt->bindParam(":acro", $datos["acro"], PDO::PARAM_STR);

    if ($stmt->execute()) {

      return "ok";

    }else{

      return "error";

    }

    $stmt->close();
    $stmt = null;

  }

  /*=============================================
  EDITAR AREA
  =============================================*/

  static public function mdlEditarArea($tabla, $datos){

    $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET descripcion = :descripcion, acro = :acro WHERE idarea = :idarea");

    $stmt->bindParam(":idarea", $datos["idarea"], PDO::PARAM_INT);
    $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
    $stmt->bindParam(":acro", $datos["acro"], PDO::PARAM_STR);

    if($stmt -> execute()){

      return "ok";

    }else{

      return "error";

    }

    $stmt -> close();

    $stmt = null;

  }

}
