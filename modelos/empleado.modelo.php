<?php

require_once "conexion.php";

class ModeloEmpleado
{

  /*=============================================
    MOSTRAR EMPLEADO Y AREA EN TABLA
  =============================================*/
  static public function mdlMostrarEmpleadoTabla($tabla)
  {

    $stmt = Conexion::conectar()->prepare("CALL $tabla");

    $stmt->execute();

    return $stmt->fetchAll();

    $stmt->close();

    $stmt = null;
  }

  /*=============================================
    MOSTRAR EMPLEADO Y AREA EN TABLA
  =============================================*/
  static public function mdlMostrarTrabajadorRol($valor)
  {

    $stmt = Conexion::conectar()->prepare("SELECT us.idusuario, us.usuario, em.nombre, em.idarea FROM  tu_usuario us INNER JOIN tu_empleado em ON us.idempleado = em.idempleado WHERE em.idarea = :idarea");

    $stmt->bindParam(":idarea", $valor, PDO::PARAM_STR);

    $stmt->execute();

    return $stmt->fetchAll();

    $stmt->close();

    $stmt = null;
  }

  /*=============================================
  MOSTRAR EMPLEADOS PARA EDITAR
  =============================================*/

  static public function mdlMostrarEditarEmpleado($tabla, $valor)
  {

    $stmt = Conexion::conectar()->prepare("CALL $tabla ($valor)");

    $stmt->execute();

    return $stmt->fetch();

    $stmt->close();

    $stmt = null;
  }

  /*=============================================
    MOSTRAR EMPLEADO
  =============================================*/
  static public function mdlMostrarEmpleado($tabla, $item, $valor)
  {

    if ($item != null) {

      $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

      $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

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
    MOSTRAR TIPO DE DOCUMENTO
  =============================================*/
  static public function mdlMostrarTipoDoc($tabla, $item, $valor)
  {

    if ($item != null) {

      $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

      $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

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
  REGISTRO DE EMPLEADO
  =============================================*/
  static public function mdlIngresarEmpleado($tabla, $datos)
  {

    $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigo, nombre, idtipodoc, nrodoc, telefono, correo, idarea, foto, estado, usu_reg) VALUES (:codigo, :nombre, :idtipodoc, :nrodoc, :telefono, :correo, :idarea, :foto, :estado, :usu_reg)");

    $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
    $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
    $stmt->bindParam(":idtipodoc", $datos["idtipodoc"], PDO::PARAM_INT);
    $stmt->bindParam(":nrodoc", $datos["nrodoc"], PDO::PARAM_STR);
    $stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
    $stmt->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
    $stmt->bindParam(":idarea", $datos["idarea"], PDO::PARAM_INT);
    $stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
    $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_INT);
    $stmt->bindParam(":usu_reg", $datos["usu_reg"], PDO::PARAM_STR);

    if ($stmt->execute()) {

      return "ok";
    } else {

      return "error";
    }

    $stmt->close();
    $stmt = null;
  }

  /*=============================================
  EDITAR EMPLEADO
  =============================================*/

  static public function mdlEditarEmpleado($tabla, $datos)
  {

    $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, idtipodoc = :idtipodoc, nrodoc = :nrodoc, telefono = :telefono, correo = :correo, idarea = :idarea, foto = :foto WHERE codigo = :codigo");

    $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
    $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
    $stmt->bindParam(":idtipodoc", $datos["idtipodoc"], PDO::PARAM_INT);
    $stmt->bindParam(":nrodoc", $datos["nrodoc"], PDO::PARAM_STR);
    $stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
    $stmt->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
    $stmt->bindParam(":idarea", $datos["idarea"], PDO::PARAM_INT);
    $stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);

    if ($stmt->execute()) {

      return "ok";
    } else {

      return "error";
    }

    $stmt->close();

    $stmt = null;
  }
}
