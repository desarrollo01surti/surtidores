<?php

require_once "conexion.php";

class ModeloVentas{

    /*=============================================
    RANGO FECHAS
    =============================================*/

  static public function mdlRangoFechasVentas($fechaInicial, $fechaFinal){

    if($fechaInicial == null){

      $stmt = Conexion::conectar()->prepare("SELECT * FROM tb_movimiento_2_2013
                                              where tipo in ('F','B')
                                              and estado='R'
                                              AND YEAR(fecha) = YEAR(CURDATE())
                                              ");

      $stmt -> execute();

      return $stmt -> fetchAll();


    }else if($fechaInicial == $fechaFinal){

      $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha like '%$fechaFinal%'");

      $stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

      $stmt -> execute();

      return $stmt -> fetchAll();

    }else{

      $fechaActual = new DateTime();
      $fechaActual ->add(new DateInterval("P1D"));
      $fechaActualMasUno = $fechaActual->format("Y-m-d");

      $fechaFinal2 = new DateTime($fechaFinal);
      $fechaFinal2 ->add(new DateInterval("P1D"));
      $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

      if($fechaFinalMasUno == $fechaActualMasUno){

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

      }else{


        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinal'");

      }

      $stmt -> execute();

      return $stmt -> fetchAll();

    }

  }

  static public function mdlProdMasVendidosxSem($tabla){

    $stmt = Conexion::conectarSurti()->prepare("SELECT DISTINCT P.ID_prod, P.descripcion, Z.ventas, Z.fecha  FROM tb_producto P
                                              LEFT JOIN
                                              (SELECT
                                              	md.ID_prod,
                                              	SUM( md.cantidad ) AS ventas,
                                              	m.fecha
                                              FROM
                                              	tb_movimiento_2_2013 m
                                              	INNER JOIN tb_movimiento_detalle_2_2013 md ON m.id_doc = md.id_doc
                                              WHERE
                                              	tipo IN ( 'F', 'B' )
                                              	AND m.estado = 'R'
                                              	AND (
                                              		YEARWEEK( m.fecha ) = YEARWEEK(NOW()) )
                                              		-- AND YEAR (NOW())
                                              GROUP BY md.ID_prod
                                              ) Z ON P.ID_prod = Z.ID_prod WHERE P.estado_prod='1'
                                              	 AND Z.ventas IS NOT NULL
                                                 ORDER BY Z.ventas DESC LIMIT 10");

    $stmt -> execute();

    return $stmt -> fetchAll();

    $stmt -> close();

		$stmt = null;

  }

}
