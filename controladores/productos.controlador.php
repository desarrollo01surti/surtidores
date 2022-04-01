<?php

class ControladorProductos
{

  /*=============================================
  MOSTRAR SUCURSAL EMPRESA
  =============================================*/

  static public function ctrMostrarProductosLike($item, $valor)
  {

    $tabla = "pro_producto";

    $respuesta = ModeloProductos::mdlMostrarProductosLike($tabla, $item, $valor);

    return $respuesta;
  }

  static public function ctrMostrarProductosProve($valor)
  {

    $respuesta = ModeloProductos::mdlMostrarProductosProve($valor);

    return $respuesta;
  }

  static public function ctrMostrarPreciosProd($valor)
  {

    $respuesta = ModeloProductos::mdlMostrarPreciosProd($valor);

    return $respuesta;
  }
}
