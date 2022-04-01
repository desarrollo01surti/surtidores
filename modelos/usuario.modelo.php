<?php

require_once "conexion.php";

class ModeloUsuario
{

  /*=============================================
    MOSTRAR USUARIOS TABLA
  =============================================*/
  static public function mdlMostrarUsuarios($tabla)
  {

    $stmt = Conexion::conectar()->prepare("CALL $tabla");

    $stmt->execute();

    return $stmt->fetchAll();

    $stmt->close();

    $stmt = null;
  }

  /*=============================================
  Mostrar Usuarios Ticket
  =============================================*/

  static public function mdlMostrarUsuariosTick($tabla, $item, $valor)
  {

    if ($item != null && $valor != null) {

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
    MOSTRAR USUARIOS INGRESO LOGIN (SESSION)
  =============================================*/
  static public function mdlMostrarUsuariosLogin($tabla, $valor)
  {

    $stmt = Conexion::conectar()->prepare("CALL $tabla ('$valor')");

    $stmt->execute();

    return $stmt->fetch();

    $stmt->close();

    $stmt = null;
  }

  static public function mdlValidarUsuarioCatalogo($valor)
  {

    $stmt = Conexion::conectarSurti()->prepare("select * from v_login_remoto WHERE token = :valor");

    $stmt->bindParam(":valor", $valor, PDO::PARAM_STR);

    $stmt->execute();

    return $stmt->fetch();

    $stmt->close();

    $stmt = null;
  }

  /*=============================================
  MOSTRAR USUARIOS FILTRO
  =============================================*/
  static public function mdlMostrarUsuariosFiltro($tabla, $item, $valor)
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
  MOSTRAR USUARIOS FILTRO
  =============================================*/
  static public function mdlMostrarNombreUsuario($valor)
  {

    $stmt = Conexion::conectar()->prepare("SELECT e.nombre FROM tu_usuario u INNER JOIN tu_empleado e ON u.idempleado=e.idempleado WHERE u.idusuario = :usuario");

    $stmt->bindParam(":usuario", $valor, PDO::PARAM_STR);

    $stmt->execute();

    return $stmt->fetch();

    $stmt->close();

    $stmt = null;
  }

  /*=============================================
  REGISTRO DE USUARIO
  =============================================*/

  static public function mdlIngresarUsuario($tabla, $datos)
  {

    $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(idempleado, idperfil, idempresa, sucursales, usuario, pass, password, estado) VALUES (:idempleado, :idperfil, :idempresa, :sucursales, :usuario, :pass, :password, :estado)");

    $stmt->bindParam(":idempleado", $datos["idempleado"], PDO::PARAM_INT);
    $stmt->bindParam(":idperfil", $datos["idperfil"], PDO::PARAM_INT);
    $stmt->bindParam(":idempresa", $datos["idempresa"], PDO::PARAM_INT);
    $stmt->bindParam(":sucursales", $datos["sucursales"], PDO::PARAM_STR);
    $stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
    $stmt->bindParam(":pass", $datos["pass"], PDO::PARAM_STR);
    $stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
    $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_INT);

    if ($stmt->execute()) {

      return "ok";
    } else {

      return "error";
    }

    $stmt->close();

    $stmt = null;
  }

  /*=============================================
  ACTUALIZAR USUARIO
  =============================================*/

  static public function mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2)
  {

    $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

    $stmt->bindParam(":" . $item1, $valor1, PDO::PARAM_STR);
    $stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);

    if ($stmt->execute()) {

      return "ok";
    } else {

      return "error";
    }

    $stmt->close();

    $stmt = null;
  }
}
