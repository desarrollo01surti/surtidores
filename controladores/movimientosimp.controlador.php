<?php

class ControladorMovimientosImp
{

  /*=============================================
  REPORTE IMPORTACION
  =============================================*/

  static public function ctrMostrarMovimientosImp($valor)
  {

    // $valida;

    $respuesta = ModeloMovimientosImp::mdlMostrarMovimientosImp($valor);

    return $respuesta;
  }

  /*=============================================
  REPORTE IMPORTACION
  =============================================*/

  static public function ctrMostrarIngresoSalida()
  {

    $tabla = "SP_INGRESOSALIDA";

    $respuesta = ModeloMovimientosImp::mdlMostrarIngresoSalida($tabla);

    return $respuesta;
  }

  /*=============================================
  MOSTRAR VENTAS
  =============================================*/

  static public function ctrMostrarSinMovimientos($valor)
  {

    $tabla = "";

    $respuesta = ModeloMovimientosImp::mdlMostrarSinMovimientos($tabla, $valor);

    return $respuesta;
  }

  /*=============================================
  FILTRAR PPRODUCTOS SIN VENTAS POR RANGO FECHAS
  =============================================*/

  static public function ctrRangoFechasVentas($fechaInicial, $fechaFinal)
  {

    $tabla = "";

    $respuesta = ModeloMovimientosImp::mdlRangoFechasVentas($tabla, $fechaInicial, $fechaFinal);

    return $respuesta;
  }
}
