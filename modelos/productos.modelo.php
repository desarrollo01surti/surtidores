<?php

require_once "conexion.php";

class ModeloProductos
{

  /*=============================================
    MOSTRAR SUCURSALES CON EMPRESA
  =============================================*/
  static public function mdlMostrarProductosLike($tabla, $item, $valor)
  {

    if ($item != null) {

      $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item LIKE :$item");

      $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

      $stmt->execute();

      return $stmt->fetchAll();
    } else {

      $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

      $stmt->execute();

      return $stmt->fetchAll();
    }

    $stmt->close();

    $stmt = null;
  }

  static public function mdlMostrarProductosProve($valor)
  {

    $stmt = Conexion::conectarSurti()->prepare("SELECT p.ID_prod, P.descripcion, pp.id_provprod, pp.id_proveedor, pp.cod_provprod, pp.moneda, pp.precio, pp.estado, pp.id_user FROM tb_producto p LEFT JOIN tb_proveedor_producto pp ON p.ID_prod=pp.ID_prod WHERE pp.id_proveedor = :valor");

    $stmt->bindParam(":valor", $valor, PDO::PARAM_STR);

    $stmt->execute();

    return $stmt->fetchAll();

    $stmt->close();

    $stmt = null;
  }

  static public function mdlMostrarPreciosProd($valor)
  {

    $stmt = Conexion::conectarSurti()->prepare("SELECT p.ID_prod, P.descripcion, pp.id_provprod, pp.id_proveedor, pp.cod_provprod, pp.moneda, pp.precio, pp.estado, pp.id_user FROM tb_producto p LEFT JOIN tb_proveedor_producto pp ON p.ID_prod=pp.ID_prod WHERE pp.id_provprod = :valor");

    $stmt->bindParam(":valor", $valor, PDO::PARAM_STR);

    $stmt->execute();

    return $stmt->fetch();

    $stmt->close();

    $stmt = null;
  }
}
