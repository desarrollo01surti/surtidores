<?php

require_once "conexion.php";

class ModeloStock{

  /*=============================================
  MOSTRAR MODULO
  =============================================*/
  static public function mdlMostrarStock($tabla, $valor){

    if($valor != null){

      // $stmt = Conexion::conectar()->prepare("CALL $tabla(':$valor')");
      //
			// $stmt -> bindParam(":".$valor, $valor, PDO::PARAM_INT);
      //
			// $stmt -> execute();
      //
			// return $stmt -> fetchAll();

		}else{

			$stmt = Conexion::conectarSurti()->prepare("SELECT
	T.ID_prod,
  CASE
		WHEN T.razon_social = '' THEN
		'SIN PROVEEDOR' ELSE T.razon_social
	END AS razon_social,
	T.descripcion,
	SUM( T.stock_total ) AS stock_total,
	SUM( T.stock_tienda ) AS stock_tienda,
	SUM( T.stock_planta ) AS stock_planta,
	SUM( T.stock_cam16 ) AS stock_cam16,
	SUM( T.stock_cam4 ) AS stock_cam4,
	SUM( T.stock_cam5 ) AS stock_cam5,
	SUM( T.stock_cam9 ) AS stock_cam9
FROM
	(
	SELECT prov.razon_social, pv.ID_prod, p.descripcion,
	  0 AS stock_total,
	  0 AS stock_tienda,
		0 AS stock_planta,
		0 AS stock_cam16,
		0 AS stock_cam4,
		0 AS stock_cam5,
		0 AS stock_cam9
	FROM tb_enlace_provprod pv LEFT JOIN tb_producto p ON pv.ID_prod = p.ID_prod
	INNER JOIN tb_proveedor prov ON pv.id_proveedor = prov.id_proveedor WHERE p.estado_prod='1'

	UNION ALL

	SELECT
	  '' AS razon_social,
		p.ID_prod,
		p.descripcion,
		SUM( SF.cantidad ) AS stock_total,
		0 AS stock_tienda,
		0 AS stock_planta,
		0 AS stock_cam16,
		0 AS stock_cam4,
		0 AS stock_cam5,
		0 AS stock_cam9
	FROM
		tb_producto p
		INNER JOIN tb_stock_final SF ON p.ID_prod = SF.ID_prod
	WHERE
		SF.id_almacen IN ( '0001', '0002', '0016', '0004', '0005', '0009' )
		AND P.tprod = 'P'
		AND SF.periodo = ( SELECT MAX( periodo ) FROM tb_stock_final )
	GROUP BY p.ID_prod

		UNION ALL

	SELECT
	  '' AS razon_social,
		p.ID_prod,
		p.descripcion,
		0 AS stock_total,
		SUM( SF.cantidad ) AS stock_tienda,
		0 AS stock_planta,
		0 AS stock_cam16,
		0 AS stock_cam4,
		0 AS stock_cam5,
		0 AS stock_cam9
	FROM
		tb_producto p
		INNER JOIN tb_stock_final SF ON p.ID_prod = SF.ID_prod
	WHERE
		SF.id_almacen = '0001'
		AND P.tprod = 'P'
		AND SF.periodo = ( SELECT MAX( periodo ) FROM tb_stock_final )
	GROUP BY
		p.ID_prod


	UNION ALL

	SELECT
	  '' AS razon_social,
		p.ID_prod,
		p.descripcion,
		0 AS stock_total,
		0 AS stock_tienda,
		SUM( SF.cantidad ) AS stock_planta,
		0 AS stock_cam16,
		0 AS stock_cam4,
		0 AS stock_cam5,
		0 AS stock_cam9
	FROM
		tb_producto p
		INNER JOIN tb_stock_final SF ON p.ID_prod = SF.ID_prod
	WHERE
		SF.id_almacen = '0002'
		AND P.tprod = 'P'
		AND SF.periodo = ( SELECT MAX( periodo ) FROM tb_stock_final )
	GROUP BY
		p.ID_prod

	UNION ALL

	SELECT
	  '' AS razon_social,
		p.ID_prod,
		p.descripcion,
		0 AS stock_total,
		0 AS stock_tienda,
		0 AS stock_planta,
		SUM( SF.cantidad ) AS stock_cam16,
		0 AS stock_cam4,
		0 AS stock_cam5,
		0 AS stock_cam9
	FROM
		tb_producto p
		INNER JOIN tb_stock_final SF ON p.ID_prod = SF.ID_prod
	WHERE
		SF.id_almacen = '0016'
		AND P.tprod = 'P'
		AND SF.periodo = ( SELECT MAX( periodo ) FROM tb_stock_final )
	GROUP BY
		p.ID_prod

	UNION ALL
	SELECT
	  '' AS razon_social,
		p.ID_prod,
		p.descripcion,
		0 AS stock_total,
		0 AS stock_tienda,
		0 AS stock_planta,
		0 AS stock_cam16,
		SUM( SF.cantidad ) AS stock_cam4,
		0 AS stock_cam5,
		0 AS stock_cam9
	FROM
		tb_producto p
		INNER JOIN tb_stock_final SF ON p.ID_prod = SF.ID_prod
	WHERE
		SF.id_almacen = '0004'
		AND P.tprod = 'P'
		AND SF.periodo = ( SELECT MAX( periodo ) FROM tb_stock_final )
	GROUP BY
		p.ID_prod

	UNION ALL

	SELECT
	  '' AS razon_social,
		p.ID_prod,
		p.descripcion,
		0 AS stock_total,
		0 AS stock_tienda,
		0 AS stock_planta,
		0 AS stock_cam16,
		0 AS stock_cam4,
		SUM( SF.cantidad ) AS stock_cam5,
		0 AS stock_cam9
	FROM
		tb_producto p
		INNER JOIN tb_stock_final SF ON p.ID_prod = SF.ID_prod
	WHERE
		SF.id_almacen = '0005'
		AND P.tprod = 'P'
		AND SF.periodo = ( SELECT MAX( periodo ) FROM tb_stock_final )
	GROUP BY
		p.ID_prod

	UNION ALL

	SELECT
	  '' AS razon_social,
		p.ID_prod,
		p.descripcion,
		0 AS stock_total,
		0 AS stock_tienda,
		0 AS stock_planta,
		0 AS stock_cam16,
		0 AS stock_cam4,
		0 AS stock_cam5,
		SUM( SF.cantidad ) AS stock_cam9
	FROM
		tb_producto p
		INNER JOIN tb_stock_final SF ON p.ID_prod = SF.ID_prod
	WHERE
		SF.id_almacen = '0009'
		AND P.tprod = 'P'
		AND SF.periodo = ( SELECT MAX( periodo ) FROM tb_stock_final )
	GROUP BY
		p.ID_prod
	) AS T 
GROUP BY T.ID_prod ORDER BY T.razon_social DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

  }


  // static public function mdlMostrarMovimientosImp($tabla, $valor){
  //
  //   if($valor != null){
  //
  //     $stmt = Conexion::conectar()->prepare("CALL $tabla(':$valor')");
  //
  //     $stmt -> bindParam(":".$valor, $valor, PDO::PARAM_INT);
  //
  //     $stmt -> execute();
  //
  //     return $stmt -> fetchAll();
  //
  //   }else{
  //
  //     $stmt = Conexion::conectar()->prepare("CALL $tabla");
  //
  //     $stmt -> execute();
  //
  //     return $stmt -> fetchAll();
  //
  //   }
  //
  //   $stmt -> close();
  //
  //   $stmt = null;
  //
  // }

}
