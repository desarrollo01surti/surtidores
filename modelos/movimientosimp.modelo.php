<?php

require_once "conexion.php";

class ModeloMovimientosImp
{

  /*=============================================
  MOSTRAR MODULO
  =============================================*/
  static public function mdlMostrarMovimientosImp()
  {

    $stmt = Conexion::conectarSurti()->prepare("SELECT P.ID_prod,
                                                  CASE
                                                     WHEN A.razon_social IS NULL THEN 'Sin Proveedor'
                                                  	 ELSE A.razon_social
                                                  END	AS razon_social, B.descripcion, B.stock_actual,
                                                  CASE
                                                     WHEN A.fechaulti IS NULL THEN '-'
                                                  	 ELSE A.fechaulti
                                                  END	AS fechaulti,
                                                  CASE
                                                     WHEN A.ingreso IS NULL THEN 0
                                                  	 ELSE A.ingreso
                                                  END	AS ultingreso,
                                                  CASE
                                                     WHEN C.fechultimavent IS NULL THEN '-'
                                                  	 ELSE C.fechultimavent
                                                  END	AS fechultimavent,
																									CASE
																										 WHEN D.ingreso IS NULL THEN 0
																										 ELSE D.ingreso
																									END	AS ingreso_mes6,
																									CASE
																										 WHEN E.salidas IS NULL THEN 0
																										 ELSE E.salidas
																									END	AS salida_mes6,
																									CASE
																										 WHEN F.ingreso IS NULL THEN 0
																										 ELSE F.ingreso
																									END	AS ingreso_mes5,
																									CASE
																										 WHEN G.salidas IS NULL THEN 0
																										 ELSE G.salidas
																									END	AS salida_mes5,
																									CASE
																										 WHEN H.ingreso IS NULL THEN 0
																										 ELSE H.ingreso
																									END	AS ingreso_mes4,
																									CASE
																										 WHEN I.salidas IS NULL THEN 0
																										 ELSE I.salidas
																									END	AS salida_mes4,
																									CASE
																										 WHEN J.ingreso IS NULL THEN 0
																										 ELSE J.ingreso
																									END	AS ingreso_mes3,
																									CASE
																										 WHEN K.salidas IS NULL THEN 0
																										 ELSE K.salidas
																									END	AS salida_mes3,
																									CASE
																										 WHEN L.ingreso IS NULL THEN 0
																										 ELSE L.ingreso
																									END	AS ingreso_mes2,
																									CASE
																										 WHEN M.salidas IS NULL THEN 0
																										 ELSE M.salidas
																									END	AS salida_mes2,
																									CASE
																										 WHEN N.ingreso IS NULL THEN 0
																										 ELSE N.ingreso
																									END	AS ingreso_mes1,
																									CASE
																										 WHEN O.salidas IS NULL THEN 0
																										 ELSE O.salidas
																									END	AS salida_mes1

                                                   FROM tb_producto P LEFT JOIN

                                                  (
                                                  -- SE OBTIENE EL ULTIMO INGRESO Y FECHA
                                                  SELECT J.ID_prod, J.fecha As fechaulti, SUM(J.cantidad) AS ingreso, J.id_proveedor, pro.razon_social
                                                  FROM (SELECT md.ID_prod, m.fecha, md.cantidad, m.id_proveedor FROM tb_movimiento_2_2013 m
                                                  INNER JOIN tb_movimiento_detalle_2_2013 md ON m.id_doc = md.id_doc WHERE m.tipo_doc IN ('E012','E020','P001')
                                                  ) J
                                                  INNER JOIN(
                                                  SELECT md.ID_prod, MAX(m.fecha) as MaxDate FROM tb_movimiento_2_2013 m
                                                  INNER JOIN tb_movimiento_detalle_2_2013 md ON m.id_doc = md.id_doc WHERE m.tipo_doc IN ('E012','E020','P001')
                                                  AND md.ID_prod <> ''
                                                  GROUP BY md.ID_prod
                                                  ) ZT ON J.ID_prod = ZT.ID_prod AND J.fecha= ZT.MaxDate
                                                  LEFT JOIN tb_proveedor pro ON J.id_proveedor = pro.id_proveedor
                                                  GROUP BY J.ID_prod

                                                  ) A ON P.ID_prod = A.ID_prod

                                                  LEFT JOIN

                                                  (
                                                  -- SE OBTIENE LA DESCRIPCION Y EL STOCK ACTUAL DEL PRODUCTO
                                                  SELECT p.ID_prod, p.descripcion, SUM(SF.cantidad) AS stock_actual FROM tb_producto p
                                                  INNER JOIN tb_stock_final SF ON p.ID_prod=SF.ID_prod
                                                  WHERE SF.id_almacen IN ('0001','0002','0016','0004','0005','0009') AND
                                                  SF.periodo = (
                                                                     SELECT MAX(periodo)
                                                                     FROM tb_stock_final
                                                                  )
                                                  GROUP BY p.ID_prod

                                                  ) B ON P.ID_prod = B.ID_prod

                                                  LEFT JOIN

																									(

                                                  -- SE OBTIENE LA FECHA DE LA ULTIMA VENTA
                                                  SELECT md.ID_prod, MAX(m.fecha) AS fechultimavent FROM tb_movimiento_2_2013 m
																									INNER JOIN tb_movimiento_detalle_2_2013 md ON m.id_doc = md.id_doc
																									WHERE tipo in ('F','B')
																									AND m.estado='R'
																									GROUP BY md.ID_prod

                                                  ) C ON P.ID_prod = C.ID_prod

                                                  LEFT JOIN

																									(

                                                  -- INGRESOS HACE 6 MESES
																									SELECT md.ID_prod, SUM(md.cantidad) AS ingreso FROM tb_movimiento_2_2013 m
																									INNER JOIN tb_movimiento_detalle_2_2013 md ON m.id_doc = md.id_doc
																									WHERE m.tipo in ('I','M')
																									AND m.tipo_doc IN ('E012','E020','P001')
																									AND MONTH(m.fecha) = MONTH(DATE_ADD(CURDATE(), INTERVAL -6 MONTH))
																									AND YEAR(m.fecha) = YEAR(DATE_ADD(CURDATE(), INTERVAL -6 MONTH))
																									GROUP BY md.ID_prod

                                                  ) D ON P.ID_prod = D.ID_prod

                                                  LEFT JOIN

																									(

                                                  -- SALIDAS HACE 6 MESES
																									SELECT md.ID_prod, SUM(md.cantidad) AS salidas FROM tb_movimiento_2_2013 m
																									INNER JOIN tb_movimiento_detalle_2_2013 md ON m.id_doc = md.id_doc
																									WHERE m.tipo in ('F','B','T')
																									AND m.tipo_doc IN ('S002','S010','T002','T004','T005','T009','T010','T012','T013','T016','T222','T223')
																									AND m.estado = 'R'
																									AND MONTH(m.fecha) = MONTH(DATE_ADD(CURDATE(), INTERVAL -6 MONTH))
																									AND YEAR(m.fecha) = YEAR(DATE_ADD(CURDATE(), INTERVAL -6 MONTH))
																									GROUP BY md.ID_prod

                                                  ) E ON P.ID_prod = E.ID_prod

                                                  LEFT JOIN

																									(

                                                  -- INGRESOS HACE 5 MESES
																									SELECT md.ID_prod, SUM(md.cantidad) AS ingreso FROM tb_movimiento_2_2013 m
																									INNER JOIN tb_movimiento_detalle_2_2013 md ON m.id_doc = md.id_doc
																									WHERE m.tipo in ('I','M')
																									AND m.tipo_doc IN ('E012','E020','P001')
																									AND MONTH(m.fecha) = MONTH(DATE_ADD(CURDATE(), INTERVAL -5 MONTH))
																									AND YEAR(m.fecha) = YEAR(DATE_ADD(CURDATE(), INTERVAL -5 MONTH))
																									GROUP BY md.ID_prod

                                                  ) F ON P.ID_prod = F.ID_prod

                                                  LEFT JOIN

																									(

                                                  -- SALIDAS HACE 5 MESES
																									SELECT md.ID_prod, SUM(md.cantidad) AS salidas FROM tb_movimiento_2_2013 m
																									INNER JOIN tb_movimiento_detalle_2_2013 md ON m.id_doc = md.id_doc
																									WHERE m.tipo in ('F','B','T')
																									AND m.tipo_doc IN ('S002','S010','T002','T004','T005','T009','T010','T012','T013','T016','T222','T223')
																									AND m.estado = 'R'
																									AND MONTH(m.fecha) = MONTH(DATE_ADD(CURDATE(), INTERVAL -5 MONTH))
																									AND YEAR(m.fecha) = YEAR(DATE_ADD(CURDATE(), INTERVAL -5 MONTH))
																									GROUP BY md.ID_prod

                                                  ) G ON P.ID_prod = G.ID_prod

																									LEFT JOIN

																									(

                                                  -- INGRESOS HACE 4 MESES
																									SELECT md.ID_prod, SUM(md.cantidad) AS ingreso FROM tb_movimiento_2_2013 m
																									INNER JOIN tb_movimiento_detalle_2_2013 md ON m.id_doc = md.id_doc
																									WHERE m.tipo in ('I','M')
																									AND m.tipo_doc IN ('E012','E020','P001')
																									AND MONTH(m.fecha) = MONTH(DATE_ADD(CURDATE(), INTERVAL -4 MONTH))
																									AND YEAR(m.fecha) = YEAR(DATE_ADD(CURDATE(), INTERVAL -4 MONTH))
																									GROUP BY md.ID_prod

                                                  ) H ON P.ID_prod = H.ID_prod

                                                  LEFT JOIN

																									(

                                                  -- SALIDAS HACE 4 MESES
																									SELECT md.ID_prod, SUM(md.cantidad) AS salidas FROM tb_movimiento_2_2013 m
																									INNER JOIN tb_movimiento_detalle_2_2013 md ON m.id_doc = md.id_doc
																									WHERE m.tipo in ('F','B','T')
																									AND m.tipo_doc IN ('S002','S010','T002','T004','T005','T009','T010','T012','T013','T016','T222','T223')
																									AND m.estado = 'R'
																									AND MONTH(m.fecha) = MONTH(DATE_ADD(CURDATE(), INTERVAL -4 MONTH))
																									AND YEAR(m.fecha) = YEAR(DATE_ADD(CURDATE(), INTERVAL -4 MONTH))
																									GROUP BY md.ID_prod

                                                  ) I ON P.ID_prod = I.ID_prod

                                                  LEFT JOIN

																									(

                                                  -- INGRESOS HACE 3 MESES
																									SELECT md.ID_prod, SUM(md.cantidad) AS ingreso FROM tb_movimiento_2_2013 m
																									INNER JOIN tb_movimiento_detalle_2_2013 md ON m.id_doc = md.id_doc
																									WHERE m.tipo in ('I','M')
																									AND m.tipo_doc IN ('E012','E020','P001')
																									AND MONTH(m.fecha) = MONTH(DATE_ADD(CURDATE(), INTERVAL -3 MONTH))
																									AND YEAR(m.fecha) = YEAR(DATE_ADD(CURDATE(), INTERVAL -3 MONTH))
																									GROUP BY md.ID_prod

                                                  ) J ON P.ID_prod = J.ID_prod

                                                  LEFT JOIN

																									(

                                                  -- SALIDAS HACE 3 MESES
																									SELECT md.ID_prod, SUM(md.cantidad) AS salidas FROM tb_movimiento_2_2013 m
																									INNER JOIN tb_movimiento_detalle_2_2013 md ON m.id_doc = md.id_doc
																									WHERE m.tipo in ('F','B','T')
																									AND m.tipo_doc IN ('S002','S010','T002','T004','T005','T009','T010','T012','T013','T016','T222','T223')
																									AND m.estado = 'R'
																									AND MONTH(m.fecha) = MONTH(DATE_ADD(CURDATE(), INTERVAL -3 MONTH))
																									AND YEAR(m.fecha) = YEAR(DATE_ADD(CURDATE(), INTERVAL -3 MONTH))
																									GROUP BY md.ID_prod

                                                  ) K ON P.ID_prod = K.ID_prod

																									LEFT JOIN

																									(

                                                  -- INGRESOS HACE 2 MESES
																									SELECT md.ID_prod, SUM(md.cantidad) AS ingreso FROM tb_movimiento_2_2013 m
																									INNER JOIN tb_movimiento_detalle_2_2013 md ON m.id_doc = md.id_doc
																									WHERE m.tipo in ('I','M')
																									AND m.tipo_doc IN ('E012','E020','P001')
																									AND MONTH(m.fecha) = MONTH(DATE_ADD(CURDATE(), INTERVAL -2 MONTH))
																									AND YEAR(m.fecha) = YEAR(DATE_ADD(CURDATE(), INTERVAL -2 MONTH))
																									GROUP BY md.ID_prod

                                                  ) L ON P.ID_prod = L.ID_prod

                                                  LEFT JOIN

																									(

                                                  -- SALIDAS HACE 2 MESES
																									SELECT md.ID_prod, SUM(md.cantidad) AS salidas FROM tb_movimiento_2_2013 m
																									INNER JOIN tb_movimiento_detalle_2_2013 md ON m.id_doc = md.id_doc
																									WHERE m.tipo in ('F','B','T')
																									AND m.tipo_doc IN ('S002','S010','T002','T004','T005','T009','T010','T012','T013','T016','T222','T223')
																									AND m.estado = 'R'
																									AND MONTH(m.fecha) = MONTH(DATE_ADD(CURDATE(), INTERVAL -2 MONTH))
																									AND YEAR(m.fecha) = YEAR(DATE_ADD(CURDATE(), INTERVAL -2 MONTH))
																									GROUP BY md.ID_prod

                                                  ) M ON P.ID_prod = M.ID_prod

                                                  LEFT JOIN

																									(

                                                  -- INGRESOS HACE 1 MES
																									SELECT md.ID_prod, SUM(md.cantidad) AS ingreso FROM tb_movimiento_2_2013 m
																									INNER JOIN tb_movimiento_detalle_2_2013 md ON m.id_doc = md.id_doc
																									WHERE m.tipo in ('I','M')
																									AND m.tipo_doc IN ('E012','E020','P001')
																									AND MONTH(m.fecha) = MONTH(DATE_ADD(CURDATE(), INTERVAL -1 MONTH))
																									AND YEAR(m.fecha) = YEAR(DATE_ADD(CURDATE(), INTERVAL -1 MONTH))
																									GROUP BY md.ID_prod

                                                  ) N ON P.ID_prod = N.ID_prod

                                                  LEFT JOIN

																									(

                                                  -- SALIDAS HACE 1 MESES
																									SELECT md.ID_prod, SUM(md.cantidad) AS salidas FROM tb_movimiento_2_2013 m
																									INNER JOIN tb_movimiento_detalle_2_2013 md ON m.id_doc = md.id_doc
																									WHERE m.tipo in ('F','B','T')
																									AND m.tipo_doc IN ('S002','S010','T002','T004','T005','T009','T010','T012','T013','T016','T222','T223')
																									AND m.estado = 'R'
																									AND MONTH(m.fecha) = MONTH(DATE_ADD(CURDATE(), INTERVAL -1 MONTH))
																									AND YEAR(m.fecha) = YEAR(DATE_ADD(CURDATE(), INTERVAL -1 MONTH))
																									GROUP BY md.ID_prod

                                                  ) O ON P.ID_prod = O.ID_prod

                                                   WHERE B.descripcion <> '' ORDER BY A.razon_social DESC");

    $stmt->execute();

    return $stmt->fetchAll();

    $stmt->close();

    $stmt = null;
  }

  /*=============================================
  RESTAR FECHAS
  =============================================*/
  static public function mdlRestarFechas($fecha)
  {

    $stmt = Conexion::conectarSurti()->prepare("SELECT TIMESTAMPDIFF(DAY, :fecha, CURDATE()) AS dias_transcurridos");

    $stmt->bindParam(":fecha", $fecha, PDO::PARAM_STR);

    $stmt->execute();

    return $stmt->fetch();

    $stmt->close();

    $stmt = null;
  }


  /*=============================================
  MOSTRAR MODULO
  =============================================*/
  static public function mdlMostrarIngresoSalida($tabla)
  {

    $stmt = Conexion::conectarSurti()->prepare("SELECT P.ID_prod,
                                                CASE
                                                   WHEN P.marca = '' THEN 'Sin Proveedor'
                                                   ELSE P.marca
                                                END	AS razon_social, P.descripcion,
                                                CASE
                                                   WHEN B.ingreso IS NULL THEN 0
                                                	 ELSE B.ingreso
                                                END	AS ingreso_enero,
                                                CASE
                                                   WHEN C.salidas IS NULL THEN 0
                                                	 ELSE C.salidas
                                                END	AS salida_enero,
                                                CASE
                                                   WHEN D.ingreso IS NULL THEN 0
                                                	 ELSE D.ingreso
                                                END	AS ingreso_febrero,
                                                CASE
                                                   WHEN E.salidas IS NULL THEN 0
                                                	 ELSE E.salidas
                                                END	AS salida_febrero,
                                                CASE
                                                   WHEN F.ingreso IS NULL THEN 0
                                                	 ELSE F.ingreso
                                                END	AS ingreso_marzo,
                                                CASE
                                                   WHEN G.salidas IS NULL THEN 0
                                                	 ELSE G.salidas
                                                END	AS salida_marzo,
                                                CASE
                                                   WHEN H.ingreso IS NULL THEN 0
                                                	 ELSE H.ingreso
                                                END	AS ingreso_abril,
                                                CASE
                                                   WHEN I.salidas IS NULL THEN 0
                                                	 ELSE I.salidas
                                                END	AS salida_abril,
                                                CASE
                                                   WHEN J.ingreso IS NULL THEN 0
                                                	 ELSE J.ingreso
                                                END	AS ingreso_mayo,
                                                CASE
                                                   WHEN K.salidas IS NULL THEN 0
                                                	 ELSE K.salidas
                                                END	AS salida_mayo,
                                                CASE
                                                   WHEN L.ingreso IS NULL THEN 0
                                                	 ELSE L.ingreso
                                                END	AS ingreso_junio,
                                                CASE
                                                   WHEN M.salidas IS NULL THEN 0
                                                	 ELSE M.salidas
                                                END	AS salida_junio,
                                                CASE
                                                   WHEN N.ingreso IS NULL THEN 0
                                                	 ELSE N.ingreso
                                                END	AS ingreso_julio,
                                                CASE
                                                   WHEN O.salidas IS NULL THEN 0
                                                	 ELSE O.salidas
                                                END	AS salida_julio,
                                                CASE
                                                   WHEN Q.ingreso IS NULL THEN 0
                                                	 ELSE Q.ingreso
                                                END	AS ingreso_agosto,
                                                CASE
                                                   WHEN R.salidas IS NULL THEN 0
                                                	 ELSE R.salidas
                                                END	AS salida_agosto,
                                                CASE
                                                   WHEN S.ingreso IS NULL THEN 0
                                                	 ELSE S.ingreso
                                                END	AS ingreso_setiembre,
                                                CASE
                                                   WHEN T.salidas IS NULL THEN 0
                                                	 ELSE T.salidas
                                                END	AS salida_setiembre,
                                                CASE
                                                   WHEN U.ingreso IS NULL THEN 0
                                                	 ELSE U.ingreso
                                                END	AS ingreso_octubre,
                                                CASE
                                                   WHEN V.salidas IS NULL THEN 0
                                                	 ELSE V.salidas
                                                END	AS salida_octubre,
                                                CASE
                                                   WHEN W.ingreso IS NULL THEN 0
                                                	 ELSE W.ingreso
                                                END	AS ingreso_noviembre,
                                                CASE
                                                   WHEN X.salidas IS NULL THEN 0
                                                	 ELSE X.salidas
                                                END	AS salida_noviembre,
                                                CASE
                                                   WHEN Y.ingreso IS NULL THEN 0
                                                	 ELSE Y.ingreso
                                                END	AS ingreso_diciembre,
                                                CASE
                                                   WHEN Z.salidas IS NULL THEN 0
                                                	 ELSE Z.salidas
                                                END	AS salida_diciembre



                                                 FROM tb_producto P LEFT JOIN

                                                (

                                                -- INGRESOS POR MES ENERO
                                                SELECT md.ID_prod, SUM(md.cantidad) AS ingreso FROM tb_movimiento_2_2013 m
                                                INNER JOIN tb_movimiento_detalle_2_2013 md ON m.id_doc = md.id_doc
                                                WHERE m.tipo in ('I','M','O')
                                                AND m.tipo_doc IN ('E012','E020','P001','E002','E004','L008')
                                                AND MONTH(m.fecha) = '1'
                                                AND YEAR(m.fecha) = YEAR(now())
                                                GROUP BY md.ID_prod

                                                ) B ON P.ID_prod = B.ID_prod

                                                LEFT JOIN

                                                (

                                                -- SALIDAS POR MES ENERO
                                                SELECT md.ID_prod, SUM(md.cantidad) AS salidas FROM tb_movimiento_2_2013 m
                                                INNER JOIN tb_movimiento_detalle_2_2013 md ON m.id_doc = md.id_doc
                                                WHERE m.tipo in ('F','B','T')
                                                AND m.tipo_doc IN ('S002','S010','T002','T004','T005','T009','T010','T012','T013','T016','T222','T223')
                                                AND m.estado='R'
                                                AND MONTH(m.fecha) = '1'
                                                AND YEAR(m.fecha) = YEAR(now())
                                                GROUP BY md.ID_prod

                                                ) C ON P.ID_prod = C.ID_prod

                                                LEFT JOIN

                                                (

                                                -- INGRESOS POR MES FEBRERO
                                                SELECT md.ID_prod, SUM(md.cantidad) AS ingreso FROM tb_movimiento_2_2013 m
                                                INNER JOIN tb_movimiento_detalle_2_2013 md ON m.id_doc = md.id_doc
                                                WHERE m.tipo in ('I','M')
                                                AND m.tipo_doc IN ('E012','E020','P001')
                                                AND MONTH(m.fecha) = '2'
                                                AND YEAR(m.fecha) = YEAR(now())
                                                GROUP BY md.ID_prod

                                                ) D ON P.ID_prod = D.ID_prod

                                                LEFT JOIN

                                                (

                                                -- SALIDAS POR MES FEBRERO
                                                SELECT md.ID_prod, SUM(md.cantidad) AS salidas FROM tb_movimiento_2_2013 m
                                                INNER JOIN tb_movimiento_detalle_2_2013 md ON m.id_doc = md.id_doc
                                                WHERE m.tipo in ('F','B','T')
                                                AND m.tipo_doc IN ('S002','S010','T002','T004','T005','T009','T010','T012','T013','T016','T222','T223')
                                                AND m.estado='R'
                                                AND MONTH(m.fecha) = '2'
                                                AND YEAR(m.fecha) = YEAR(now())
                                                GROUP BY md.ID_prod

                                                ) E ON P.ID_prod = E.ID_prod


                                                LEFT JOIN

                                                (

                                                -- INGRESOS POR MES MARZO
                                                SELECT md.ID_prod, SUM(md.cantidad) AS ingreso FROM tb_movimiento_2_2013 m
                                                INNER JOIN tb_movimiento_detalle_2_2013 md ON m.id_doc = md.id_doc
                                                WHERE m.tipo in ('I','M')
                                                AND m.tipo_doc IN ('E012','E020','P001')
                                                AND MONTH(m.fecha) = '3'
                                                AND YEAR(m.fecha) = YEAR(now())
                                                GROUP BY md.ID_prod

                                                ) F ON P.ID_prod = F.ID_prod

                                                LEFT JOIN

                                                (

                                                -- SALIDAS POR MES MARZO
                                                SELECT md.ID_prod, SUM(md.cantidad) AS salidas FROM tb_movimiento_2_2013 m
                                                INNER JOIN tb_movimiento_detalle_2_2013 md ON m.id_doc = md.id_doc
                                                WHERE m.tipo in ('F','B','T')
                                                AND m.tipo_doc IN ('S002','S010','T002','T004','T005','T009','T010','T012','T013','T016','T222','T223')
                                                AND m.estado='R'
                                                AND MONTH(m.fecha) = '3'
                                                AND YEAR(m.fecha) = YEAR(now())
                                                GROUP BY md.ID_prod

                                                ) G ON P.ID_prod = G.ID_prod

                                                LEFT JOIN

                                                (

                                                -- INGRESOS POR MES ABRIL
                                                SELECT md.ID_prod, SUM(md.cantidad) AS ingreso FROM tb_movimiento_2_2013 m
                                                INNER JOIN tb_movimiento_detalle_2_2013 md ON m.id_doc = md.id_doc
                                                WHERE m.tipo in ('I','M')
                                                AND m.tipo_doc IN ('E012','E020','P001')
                                                AND MONTH(m.fecha) = '4'
                                                AND YEAR(m.fecha) = YEAR(now())
                                                GROUP BY md.ID_prod

                                                ) H ON P.ID_prod = H.ID_prod

                                                LEFT JOIN

                                                (

                                                -- SALIDAS POR MES ABRIL
                                                SELECT md.ID_prod, SUM(md.cantidad) AS salidas FROM tb_movimiento_2_2013 m
                                                INNER JOIN tb_movimiento_detalle_2_2013 md ON m.id_doc = md.id_doc
                                                WHERE m.tipo in ('F','B','T')
                                                AND m.tipo_doc IN ('S002','S010','T002','T004','T005','T009','T010','T012','T013','T016','T222','T223')
                                                AND m.estado='R'
                                                AND MONTH(m.fecha) = '4'
                                                AND YEAR(m.fecha) = YEAR(now())
                                                GROUP BY md.ID_prod

                                                ) I ON P.ID_prod = I.ID_prod

                                                LEFT JOIN

                                                (

                                                -- INGRESOS POR MES MAYO
                                                SELECT md.ID_prod, SUM(md.cantidad) AS ingreso FROM tb_movimiento_2_2013 m
                                                INNER JOIN tb_movimiento_detalle_2_2013 md ON m.id_doc = md.id_doc
                                                WHERE m.tipo in ('I','M')
                                                AND m.tipo_doc IN ('E012','E020','P001')
                                                AND MONTH(m.fecha) = '5'
                                                AND YEAR(m.fecha) = YEAR(now())
                                                GROUP BY md.ID_prod

                                                ) J ON P.ID_prod = J.ID_prod

                                                LEFT JOIN

                                                (

                                                -- SALIDAS POR MES MAYO
                                                SELECT md.ID_prod, SUM(md.cantidad) AS salidas FROM tb_movimiento_2_2013 m
                                                INNER JOIN tb_movimiento_detalle_2_2013 md ON m.id_doc = md.id_doc
                                                WHERE m.tipo in ('F','B','T')
                                                AND m.tipo_doc IN ('S002','S010','T002','T004','T005','T009','T010','T012','T013','T016','T222','T223')
                                                AND m.estado='R'
                                                AND MONTH(m.fecha) = '5'
                                                AND YEAR(m.fecha) = YEAR(now())
                                                GROUP BY md.ID_prod

                                                ) K ON P.ID_prod = K.ID_prod

                                                LEFT JOIN

                                                (
                                                -- INGRESOS POR MES JUNIO
                                                SELECT md.ID_prod, SUM(md.cantidad) AS ingreso FROM tb_movimiento_2_2013 m
                                                INNER JOIN tb_movimiento_detalle_2_2013 md ON m.id_doc = md.id_doc
                                                WHERE m.tipo in ('I','M')
                                                AND m.tipo_doc IN ('E012','E020','P001')
                                                AND MONTH(m.fecha) = '6'
                                                AND YEAR(m.fecha) = YEAR(now())
                                                GROUP BY md.ID_prod

                                                ) L ON P.ID_prod = L.ID_prod

                                                LEFT JOIN

                                                (

                                                -- SALIDAS POR MES JUNIO
                                                SELECT md.ID_prod, SUM(md.cantidad) AS salidas FROM tb_movimiento_2_2013 m
                                                INNER JOIN tb_movimiento_detalle_2_2013 md ON m.id_doc = md.id_doc
                                                WHERE m.tipo in ('F','B','T')
                                                AND m.tipo_doc IN ('S002','S010','T002','T004','T005','T009','T010','T012','T013','T016','T222','T223')
                                                AND m.estado='R'
                                                AND MONTH(m.fecha) = '6'
                                                AND YEAR(m.fecha) = YEAR(now())
                                                GROUP BY md.ID_prod

                                                ) M ON P.ID_prod = M.ID_prod

                                                LEFT JOIN

                                                (

                                                -- INGRESOS POR MES JULIO
                                                SELECT md.ID_prod, SUM(md.cantidad) AS ingreso FROM tb_movimiento_2_2013 m
                                                INNER JOIN tb_movimiento_detalle_2_2013 md ON m.id_doc = md.id_doc
                                                WHERE m.tipo in ('I','M')
                                                AND m.tipo_doc IN ('E012','E020','P001')
                                                AND MONTH(m.fecha) = '7'
                                                AND YEAR(m.fecha) = YEAR(now())
                                                GROUP BY md.ID_prod

                                                ) N ON P.ID_prod = N.ID_prod

                                                LEFT JOIN

                                                (

                                                -- SALIDAS POR MES JULIO
                                                SELECT md.ID_prod, SUM(md.cantidad) AS salidas FROM tb_movimiento_2_2013 m
                                                INNER JOIN tb_movimiento_detalle_2_2013 md ON m.id_doc = md.id_doc
                                                WHERE m.tipo in ('F','B','T')
                                                AND m.tipo_doc IN ('S002','S010','T002','T004','T005','T009','T010','T012','T013','T016','T222','T223')
                                                AND m.estado='R'
                                                AND MONTH(m.fecha) = '7'
                                                AND YEAR(m.fecha) = YEAR(now())
                                                GROUP BY md.ID_prod

                                                ) O ON P.ID_prod = O.ID_prod

                                                LEFT JOIN

                                                (

                                                -- INGRESOS POR MES AGOSTO
                                                SELECT md.ID_prod, SUM(md.cantidad) AS ingreso FROM tb_movimiento_2_2013 m
                                                INNER JOIN tb_movimiento_detalle_2_2013 md ON m.id_doc = md.id_doc
                                                WHERE m.tipo in ('I','M')
                                                AND m.tipo_doc IN ('E012','E020','P001')
                                                AND MONTH(m.fecha) = '8'
                                                AND YEAR(m.fecha) = YEAR(now())
                                                GROUP BY md.ID_prod

                                                ) Q ON P.ID_prod = Q.ID_prod

                                                LEFT JOIN

                                                (

                                                -- SALIDAS POR MES AGOSTO
                                                SELECT md.ID_prod, SUM(md.cantidad) AS salidas FROM tb_movimiento_2_2013 m
                                                INNER JOIN tb_movimiento_detalle_2_2013 md ON m.id_doc = md.id_doc
                                                WHERE m.tipo in ('F','B','T')
                                                AND m.tipo_doc IN ('S002','S010','T002','T004','T005','T009','T010','T012','T013','T016','T222','T223')
                                                AND m.estado = 'R'
                                                AND MONTH(m.fecha) = '8'
                                                AND YEAR(m.fecha) = YEAR(now())
                                                GROUP BY md.ID_prod

                                                ) R ON P.ID_prod = R.ID_prod


                                                LEFT JOIN

                                                (

                                                -- INGRESOS POR MES SETIEMBRE
                                                SELECT md.ID_prod, SUM(md.cantidad) AS ingreso FROM tb_movimiento_2_2013 m
                                                INNER JOIN tb_movimiento_detalle_2_2013 md ON m.id_doc = md.id_doc
                                                WHERE m.tipo in ('I','M')
                                                AND m.tipo_doc IN ('E012','E020','P001')
                                                AND MONTH(m.fecha) = '9'
                                                AND YEAR(m.fecha) = YEAR(now())
                                                GROUP BY md.ID_prod

                                                ) S ON P.ID_prod = S.ID_prod

                                                LEFT JOIN

                                                (

                                                -- SALIDAS POR MES SETIEMBRE
                                                SELECT md.ID_prod, SUM(md.cantidad) AS salidas FROM tb_movimiento_2_2013 m
                                                INNER JOIN tb_movimiento_detalle_2_2013 md ON m.id_doc = md.id_doc
                                                WHERE m.tipo in ('F','B','T')
                                                AND m.tipo_doc IN ('S002','S010','T002','T004','T005','T009','T010','T012','T013','T016','T222','T223')
                                                AND m.estado='R'
                                                AND MONTH(m.fecha) = '9'
                                                AND YEAR(m.fecha) = YEAR(now())
                                                GROUP BY md.ID_prod

                                                ) T ON P.ID_prod = T.ID_prod

                                                LEFT JOIN

                                                (

                                                -- INGRESOS POR MES OCTUBRE
                                                SELECT md.ID_prod, SUM(md.cantidad) AS ingreso FROM tb_movimiento_2_2013 m
                                                INNER JOIN tb_movimiento_detalle_2_2013 md ON m.id_doc = md.id_doc
                                                WHERE m.tipo in ('I','M')
                                                AND m.tipo_doc IN ('E012','E020','P001')
                                                AND MONTH(m.fecha) = '10'
                                                AND YEAR(m.fecha) = YEAR(now())
                                                GROUP BY md.ID_prod

                                                ) U ON P.ID_prod = U.ID_prod

                                                LEFT JOIN

                                                (

                                                -- SALIDAS POR MES OCTUBRE
                                                SELECT md.ID_prod, SUM(md.cantidad) AS salidas FROM tb_movimiento_2_2013 m
                                                INNER JOIN tb_movimiento_detalle_2_2013 md ON m.id_doc = md.id_doc
                                                WHERE m.tipo in ('F','B','T')
                                                AND m.tipo_doc IN ('S002','S010','T002','T004','T005','T009','T010','T012','T013','T016','T222','T223')
                                                AND m.estado='R'
                                                AND MONTH(m.fecha) = '10'
                                                AND YEAR(m.fecha) = YEAR(now())
                                                GROUP BY md.ID_prod

                                                ) V ON P.ID_prod = V.ID_prod

                                                LEFT JOIN

                                                (

                                                -- INGRESOS POR MES NOVIEMBRE
                                                SELECT md.ID_prod, SUM(md.cantidad) AS ingreso FROM tb_movimiento_2_2013 m
                                                INNER JOIN tb_movimiento_detalle_2_2013 md ON m.id_doc = md.id_doc
                                                WHERE m.tipo in ('I','M')
                                                AND m.tipo_doc IN ('E012','E020','P001')
                                                AND MONTH(m.fecha) = '11'
                                                AND YEAR(m.fecha) = YEAR(now())
                                                GROUP BY md.ID_prod

                                                ) W ON P.ID_prod = W.ID_prod

                                                LEFT JOIN

                                                (

                                                -- SALIDAS POR MES NOVIEMBRE
                                                SELECT md.ID_prod, SUM(md.cantidad) AS salidas FROM tb_movimiento_2_2013 m
                                                INNER JOIN tb_movimiento_detalle_2_2013 md ON m.id_doc = md.id_doc
                                                WHERE m.tipo in ('F','B','T')
                                                AND m.tipo_doc IN ('S002','S010','T002','T004','T005','T009','T010','T012','T013','T016','T222','T223')
                                                AND m.estado='R'
                                                AND MONTH(m.fecha) = '11'
                                                AND YEAR(m.fecha) = YEAR(now())
                                                GROUP BY md.ID_prod

                                                ) X ON P.ID_prod = X.ID_prod

                                                LEFT JOIN

                                                (

                                                -- INGRESOS POR MES DICIEMBRE
                                                SELECT md.ID_prod, SUM(md.cantidad) AS ingreso FROM tb_movimiento_2_2013 m
                                                INNER JOIN tb_movimiento_detalle_2_2013 md ON m.id_doc = md.id_doc
                                                WHERE m.tipo in ('I','M')
                                                AND m.tipo_doc IN ('E012','E020','P001')
                                                AND MONTH(m.fecha) = '12'
                                                AND YEAR(m.fecha) = YEAR(now())
                                                GROUP BY md.ID_prod

                                                ) Y ON P.ID_prod = Y.ID_prod

                                                LEFT JOIN

                                                (

                                                -- SALIDAS POR MES DICIEMBRE
                                                SELECT md.ID_prod, SUM(md.cantidad) AS salidas FROM tb_movimiento_2_2013 m
                                                INNER JOIN tb_movimiento_detalle_2_2013 md ON m.id_doc = md.id_doc
                                                WHERE m.tipo in ('F','B','T')
                                                AND m.tipo_doc IN ('S002','S010','T002','T004','T005','T009','T010','T012','T013','T016','T222','T223')
                                                AND m.estado = 'R'
                                                AND MONTH(m.fecha) = '12'
                                                AND YEAR(m.fecha) = YEAR(now())
                                                GROUP BY md.ID_prod

                                                ) Z ON P.ID_prod = Z.ID_prod");

    $stmt->execute();

    return $stmt->fetchAll();

    $stmt->close();

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


  /*=============================================
  MOSTRAR PRODUCTOS SIN VENTAS
  =============================================*/

  static public function mdlMostrarSinMovimientos($tabla, $valor)
  {

    if ($valor != null) {

      //COMENTADO SIN DATOS DE MUESTRA
      // $stmt = Conexion::conectar()->prepare("");
      //
      // $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
      //
      // $stmt -> execute();
      //
      // return $stmt -> fetch();

    } else {

      $stmt = Conexion::conectarSurti()->prepare("SELECT DISTINCT P.ID_prod, P.descripcion,
                                              CASE
                                                  WHEN Z.promedio_vent IS NULL THEN 'Sin Ventas'
                                              		ELSE Z.promedio_vent
                                              END AS ventas
                                              FROM tb_producto P

                                              LEFT JOIN

                                              (SELECT
                                              	md.ID_prod,
                                              	SUM( md.cantidad ) AS promedio_vent
                                              FROM
                                              	tb_movimiento_2_2013 m
                                              	INNER JOIN tb_movimiento_detalle_2_2013 md ON m.id_doc = md.id_doc
                                              WHERE
                                              	tipo IN ( 'F', 'B' )
                                              	AND m.estado = 'R'
                                              	AND
                                              		m.fecha BETWEEN '2021-01-01' AND NOW()
                                              GROUP BY
                                              	md.ID_prod
                                              ) Z ON P.ID_prod = Z.ID_prod WHERE P.estado_prod='1'
                                              	 AND Z.promedio_vent IS NULL");

      $stmt->execute();

      return $stmt->fetchAll();
    }

    $stmt->close();

    $stmt = null;
  }

  /*=============================================
    RANGO FECHAS
    =============================================*/

  static public function mdlRangoFechasVentas($tabla, $fechaInicial, $fechaFinal)
  {

    if ($fechaInicial == null) {

      $stmt = Conexion::conectarSurti()->prepare("SELECT DISTINCT P.ID_prod, P.descripcion,
                                                CASE
                                                    WHEN Z.promedio_vent IS NULL THEN 'Sin Ventas'
                                                		ELSE Z.promedio_vent
                                                END AS ventas
                                                FROM tb_producto P

                                                LEFT JOIN

                                                (SELECT
                                                	md.ID_prod,
                                                	SUM( md.cantidad ) AS promedio_vent
                                                FROM
                                                	tb_movimiento_2_2013 m
                                                	INNER JOIN tb_movimiento_detalle_2_2013 md ON m.id_doc = md.id_doc
                                                WHERE
                                                	tipo IN ( 'F', 'B' )
                                                	AND m.estado = 'R'
                                                	AND
                                                		YEAR(m.fecha) = YEAR(NOW())
                                                GROUP BY
                                                	md.ID_prod
                                                ) Z ON P.ID_prod = Z.ID_prod WHERE P.estado_prod='1'
                                                	 AND Z.promedio_vent IS NULL");

      $stmt->execute();

      return $stmt->fetchAll();

      $stmt->close();

      $stmt = null;
    } else if ($fechaInicial == $fechaFinal) {

      $stmt = Conexion::conectarSurti()->prepare("SELECT DISTINCT P.ID_prod, P.descripcion,
                                                CASE
                                                    WHEN Z.promedio_vent IS NULL THEN 'Sin Ventas'
                                                		ELSE Z.promedio_vent
                                                END AS ventas
                                                FROM tb_producto P
                                                LEFT JOIN
                                                (SELECT
                                                	md.ID_prod,
                                                	SUM( md.cantidad ) AS promedio_vent
                                                FROM
                                                	tb_movimiento_2_2013 m
                                                	INNER JOIN tb_movimiento_detalle_2_2013 md ON m.id_doc = md.id_doc
                                                WHERE
                                                	tipo IN ( 'F', 'B' )
                                                	AND m.estado = 'R'
                                                	AND
                                                		m.fecha like '%$fechaFinal%'
                                                GROUP BY
                                                	md.ID_prod
                                                ) Z ON P.ID_prod = Z.ID_prod WHERE P.estado_prod='1'
                                                	 AND Z.promedio_vent IS NULL");

      $stmt->bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

      $stmt->execute();

      return $stmt->fetchAll();

      $stmt->close();

      $stmt = null;
    } else {

      $fechaActual = new DateTime();
      $fechaActual->add(new DateInterval("P1D"));
      $fechaActualMasUno = $fechaActual->format("Y-m-d");

      $fechaFinal2 = new DateTime($fechaFinal);
      $fechaFinal2->add(new DateInterval("P1D"));
      $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

      if ($fechaFinalMasUno == $fechaActualMasUno) {

        $stmt = Conexion::conectarSurti()->prepare("SELECT DISTINCT P.ID_prod, P.descripcion,
                                                  CASE
                                                      WHEN Z.promedio_vent IS NULL THEN 'Sin Ventas'
                                                  		ELSE Z.promedio_vent
                                                  END AS ventas
                                                  FROM tb_producto P
                                                  LEFT JOIN
                                                  (SELECT
                                                  	md.ID_prod,
                                                  	SUM( md.cantidad ) AS promedio_vent
                                                  FROM
                                                  	tb_movimiento_2_2013 m
                                                  	INNER JOIN tb_movimiento_detalle_2_2013 md ON m.id_doc = md.id_doc
                                                  WHERE
                                                  	tipo IN ( 'F', 'B' )
                                                  	AND m.estado = 'R'
                                                  	AND
                                                  		m.fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'
                                                  GROUP BY
                                                  	md.ID_prod
                                                  ) Z ON P.ID_prod = Z.ID_prod WHERE P.estado_prod='1'
                                                  	 AND Z.promedio_vent IS NULL");
      } else {


        $stmt = Conexion::conectar()->prepare("SELECT DISTINCT P.ID_prod, P.descripcion,
                                                  CASE
                                                      WHEN Z.promedio_vent IS NULL THEN 'Sin Ventas'
                                                  		ELSE Z.promedio_vent
                                                  END AS ventas
                                                  FROM tb_producto P
                                                  LEFT JOIN
                                                  (SELECT
                                                  	md.ID_prod,
                                                  	SUM( md.cantidad ) AS promedio_vent
                                                  FROM
                                                  	tb_movimiento_2_2013 m
                                                  	INNER JOIN tb_movimiento_detalle_2_2013 md ON m.id_doc = md.id_doc
                                                  WHERE
                                                  	tipo IN ( 'F', 'B' )
                                                  	AND m.estado = 'R'
                                                  	AND
                                                  		m.fecha BETWEEN '$fechaInicial' AND '$fechaFinal'
                                                  GROUP BY
                                                  	md.ID_prod
                                                  ) Z ON P.ID_prod = Z.ID_prod WHERE P.estado_prod='1'
                                                  	 AND Z.promedio_vent IS NULL");
      }

      $stmt->execute();

      return $stmt->fetchAll();

      $stmt->close();

      $stmt = null;
    }
  }
}
