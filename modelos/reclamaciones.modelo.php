<?php

require_once "conexion.php";

class ModeloReclamos{

      /*=============================================
      MOSTRAR RECLAMOS TABLA
      =============================================*/

      static public function mdlMostrarReclamosTabla($tabla, $item, $valor){

        if($item != null){

          $stmt = Conexion::conectar()->prepare("SELECT *, DATE_FORMAT(fecha_ingreso, '%d/%m/%y')AS fecha FROM $tabla WHERE $item = :$item ORDER BY id DESC");

          $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

          $stmt -> execute();

          return $stmt -> fetchAll();

        }else{

          $stmt = Conexion::conectar()->prepare("SELECT *, DATE_FORMAT(fecha_ingreso, '%d/%m/%y')AS fecha FROM $tabla ORDER BY fecha_ingreso DESC");

          $stmt -> execute();

          return $stmt -> fetchAll();

        }

        $stmt -> close();

        $stmt = null;

      }

      /*=============================================
      MOSTRAR RECLAMOS GENERAL
      =============================================*/

      static public function mdlMostrarReclamos($tabla, $item, $valor){

        if($item != null){

          $stmt = Conexion::conectar()->prepare("SELECT *, DATE_FORMAT(fecha_ingreso, '%d/%m/%y')AS fecha, DATE_FORMAT(fecha_respuesta, '%d/%m/%y')AS fecharesp FROM $tabla WHERE $item = :$item ORDER BY id DESC");

          $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

          $stmt -> execute();

          return $stmt -> fetch();

        }else{

          $stmt = Conexion::conectar()->prepare("SELECT *, DATE_FORMAT(fecha_ingreso, '%d/%m/%y')AS fecha, DATE_FORMAT(fecha_respuesta, '%d/%m/%y')AS fecharesp FROM $tabla ORDER BY fecha_ingreso DESC");

          $stmt -> execute();

          return $stmt -> fetchAll();

        }

        $stmt -> close();

        $stmt = null;

      }

      /*=============================================
      MOSTRAR RECLAMOS Pdf Respuesta
      =============================================*/

      static public function mdlMostrarReclamosPdf($tabla, $item, $valor){

        if($item != null){

          $stmt = Conexion::conectar()->prepare("SELECT *, DATE_FORMAT(fecha_ingreso, '%d/%m/%y')AS fecha, DATE_FORMAT(fecha_respuesta, '%d/%m/%y')AS fecharesp FROM $tabla WHERE $item = :$item ORDER BY id DESC");

          $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

          $stmt -> execute();

          return $stmt -> fetch();

        }else{

          $stmt = Conexion::conectar()->prepare("SELECT *, DATE_FORMAT(fecha_ingreso, '%d/%m/%y')AS fecha, DATE_FORMAT(fecha_respuesta, '%d/%m/%y')AS fecharesp FROM $tabla ORDER BY fecha_ingreso DESC");

          $stmt -> execute();

          return $stmt -> fetchAll();

        }

        $stmt -> close();

        $stmt = null;

      }

      /*=============================================
      REGISTRAR RESPUESTA DE RECLAMOS
      =============================================*/

      static public function mdlRegistrarReclamo($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET detalle_respuesta = :detalle_respuesta, fecha_respuesta = :fecha_respuesta, estado = :estado, responsable = :responsable WHERE codigo = :codigo");

        $stmt->bindParam(":detalle_respuesta", $datos["detalle_respuesta"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_respuesta", $datos["fecha_respuesta"], PDO::PARAM_STR);
        $stmt->bindParam(":responsable", $datos["responsable"], PDO::PARAM_STR);
        $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_INT);
        $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);

        if($stmt -> execute()){

          return "ok";

        }else{

          return "error";

        }

        $stmt -> close();

        $stmt = null;

      }

      /*=============================================
      ACTUALIZAR DATO
      =============================================*/

      static public function mdlActualizarReclamo($tabla, $item1, $valor1, $item2, $valor2){

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

        $stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
        $stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

        if($stmt -> execute()){

          return "ok";

        }else{

          return "error";

        }

        $stmt -> close();

        $stmt = null;

      }

}
