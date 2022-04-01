<?php

require_once "conexion.php";

class ModeloOrdenCompra
{

    /*=============================================
	MOSTRAR ORDEN DE COMPRA CABECERA
	=============================================*/

    static public function mdlMostrarOrdenCab($tabla, $item, $valor)
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
	MOSTRAR ORDEN DE COMPRA CABECERA
	=============================================*/

    static public function mdlMostrarUltimaOrden($tabla)
    {

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_orden = (SELECT MAX(id_orden) FROM $tabla)");

        $stmt->execute();

        return $stmt->fetch();

        $stmt->close();

        $stmt = null;
    }
    /*=============================================
	MOSTRAR TIPO DE VIA
	=============================================*/

    static public function mdlMostrarVia($tabla, $item, $valor)
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
}
